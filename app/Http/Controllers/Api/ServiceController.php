<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Service;
use App\Http\Resources\Panel as PanelResource;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{

    function __construct()
    {
    	$this->middleware('auth:api');
    }

    private $pagination = 5;

    public function getAllItems()
    {
        $items = Service::all();

        return PanelResource::collection($items);
    }

    public function getItems()
    {
    	$items = Service::query();

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
    	$item = Service::findOrFail($id);

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
            'name' => ['required','string','unique:App\Models\Service'],
            'servicesubcategory_id' => ['required','numeric'],
            'price' => ['required','string'],
            'duration' => ['required','numeric'],
            'status' => ['required','numeric'],
            'availability' => ['required','numeric'],
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

                $image = Image::make(public_path("/storage/{$imagePath}"))->fit(600,500);

                $image->save();

                }

            $data['slug'] = createSlug($data['name']);
            $item = Service::create([
                'name'=>$data['name'],
                'slug'=>$data['slug'],
                'price'=>$data['price'],
                'duration'=>$data['duration'],
                'status'=>$data['status'],
                'availability'=>$data['availability'],
                'details'=>$data['details'],
                'image'=>$imagePath ?? null
            ]);

            $item->servicesubcategory()->associate($data['servicesubcategory_id']);
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
            'name' => ['required','string',Rule::unique('App\Models\Service')->ignore($id)],
            'servicesubcategory_id' => ['required','numeric'],
            'price' => ['required','string'],
            'duration' => ['required','numeric'],
            'status' => ['required','numeric'],
            'availability' => ['required','numeric'],
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

                $image = Image::make(public_path("/storage/{$imagePath}"))->fit(600,500);

                $image->save();

                }

            $data['slug'] = createSlug($data['name']);
            $item = Service::findOrFail($id);

            $item->update([
                'name'=>$data['name'],
                'slug'=>$data['slug'],
                'price'=>$data['price'],
                'duration'=>$data['duration'],
                'status'=>$data['status'],
                'availability'=>$data['availability'],
                'details'=>$data['details'],
                'image'=>$imagePath ?? $item->image
            ]);

            $item->servicesubcategory()->dissociate();
            $item->servicesubcategory()->associate($data['servicesubcategory_id']);
            $item->save();

            $item->image = getImage($item->image);

            return new PanelResource($item);
        }
    }

    public function updateStatus($id,$status)
    {
    	$item = Service::findOrFail($id);
    	$item->status = $status;

    	if ($item->save()) {

    		return response()->json([
	            'success' => true
	        ], 201);

    	}

    	return ;
    }

    private function getPriority($priorityName)
    {
        $priorityArr = [
         'low' => 1,
         'medium' => 2,
         'high' => 3
        ];

        return $priorityArr[$priorityName];
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