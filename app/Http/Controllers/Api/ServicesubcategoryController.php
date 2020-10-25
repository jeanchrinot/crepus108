<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Servicesubcategory;
use App\Http\Resources\Panel as PanelResource;
use Intervention\Image\Facades\Image;

class ServicesubcategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('auth:api');
    }

    private $pagination = 5;

    public function getAllItems()
    {
        $items = Servicesubcategory::all();

        return PanelResource::collection($items);
    }

    public function getItems()
    {
        $items = Servicesubcategory::query();

        if (request()->priority && request()->status) {
                // Filter by priority and status
                $priority = $this->getPriority(request()->priority);
                $status = $this->getStatus(request()->status);

                if(is_numeric($priority) && is_numeric($status)){
                    $items = $items->where(['priority'=>$priority,'status'=>$status]);
                }

            }
            elseif(request()->priority){
                $priority = $this->getPriority(request()->priority);
                if(is_numeric($priority)){
                    $items = $items->where('priority',$priority);
                }
            }
            elseif (request()->status) {
                $status = $this->getStatus(request()->status);

                if(is_numeric($status)){
                    $items = $items->where('status',$status);
                }
            }
            
            $order = request()->order ?? 'desc';
            
            $items = $items->orderBy('created_at',$order);
            

            // Search 
            if(request()->search) {
                $keyword = request()->search;
                $items = $items->where(function ($query) use($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')->orderBy('id','desc');
                })->paginate($this->pagination);
            }
            else{

                $items = $items->paginate($this->pagination);
            }

            $items = $this->modifyImagePath($items);

        return PanelResource::collection($items);
    }

    public function destroy($id)
    {
        $item = Servicesubcategory::findOrFail($id);

        if($item->delete()){
            return response()->json([
                'success' => true
            ], 201);
        }

        return ;
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $validation = Validator::make($data,[ 
            'name' => ['required','string','unique:App\Models\Servicesubcategory'],
            'servicecategory_id' => ['required','numeric'],
            'status' => ['required','numeric'],
            'details' => '',
            'image'=>''
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            if ($request->file('image')) {

                $image = $request->file('image');

                $imagePath = $image->store('service','public');

                $image = Image::make(public_path("/storage/{$imagePath}"))->fit(500,300);

                $image->save();

                }

            $data['slug'] = createSlug($data['name']);
            $item = Servicesubcategory::create([
                'name'=>$data['name'],
                'slug'=>$data['slug'],
                'status'=>$data['status'],
                'details'=>$data['details'],
                'image'=>$imagePath ?? null
            ]);

            $item->servicecategory()->associate($data['servicecategory_id']);
            $item->save();

            $item->image = getImage($item->image);

            return new PanelResource($item);
        }
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();

        // return new PanelResource($request->file('image'));

        $validation = Validator::make($data,[ 
            'name' => ['required','string',Rule::unique('App\Models\Servicesubcategory')->ignore($id)],
            'servicecategory_id' => ['required','numeric'],
            'status' => ['required','numeric'],
            'details' => '',
            'image'=>''
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            if ($request->file('image')) {

                $image = $request->file('image');

                $imagePath = $image->store('service','public');

                $image = Image::make(public_path("/storage/{$imagePath}"))->fit(500,300);

                $image->save();

                }

            $data['slug'] = createSlug($data['name']);
            $item = Servicesubcategory::findOrFail($id);

            $item->update([
                'name'=>$data['name'],
                'slug'=>$data['slug'],
                'status'=>$data['status'],
                'details'=>$data['details'],
                'image'=>$imagePath ?? $item->image
            ]);

            $item->servicecategory()->dissociate();
            $item->servicecategory()->associate($data['servicecategory_id']);
            $item->save();

            $item->image = getImage($item->image);

            return new PanelResource($item);
        }
    }

    private function getStatus($statusName)
    {
        $statusArr = [
         'passive' => 0,
         'active' => 1
        ];

        return $statusArr[$statusName];
    }

    private function modifyImagePath($items)
    {
        $transformedItems = $items->getCollection()->map(function($item) {
                $item['image'] = getImage($item['image']);
                return $item;
        });
        
        $items->setCollection($transformedItems);

        return $items;
    }
}