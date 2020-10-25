<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Brand;
use App\Http\Resources\Panel as PanelResource;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{

    function __construct()
    {
    	$this->middleware('auth:api');
    }

    private $pagination = 5;

    public function getAllItems()
    {
        $items = Brand::all();

        return PanelResource::collection($items);
    }

    public function getItems()
    {
    	$items = Brand::query();

    
           
            if (request()->status) {
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
    	$item = Brand::findOrFail($id);

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
            'name' => ['required','string','unique:App\Models\Brand'],
            'status' => ['required','numeric'],
            'logo'=>'required|image'
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            if ($request->file('logo')) {

                $logo = $request->file('logo');

                $logoPath = $logo->store('brand','public');

                $logo = Image::make(public_path("/storage/{$logoPath}"))->fit(265,138);

                $logo->save();

                }

            $item = Brand::create([
                'name'=>$data['name'],
                'status'=>$data['status'],
                'logo'=>$logoPath ?? null
            ]);

            $item->logo = getImage($item->logo);

            return new PanelResource($item);
        }
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();

        // return new PanelResource($request->file('logo'));

        $validation = Validator::make($data,[ 
            'name' => ['required','string',Rule::unique('App\Models\Brand')->ignore($id)],
            'status' => ['required','numeric'],
            'logo'=>''
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            if ($request->file('logo')) {

                $logo = $request->file('logo');

                $logoPath = $logo->store('brand','public');

                $logo = Image::make(public_path("/storage/{$logoPath}"))->fit(265,138);

                $logo->save();

                }

            $item = Brand::findOrFail($id);

            $item->update([
                'name'=>$data['name'],
                'status'=>$data['status'],
                'logo'=>$logoPath ?? $item->logo
            ]);

            $item->logo = getImage($item->logo);

            return new PanelResource($item);
        }
    }

    public function updateStatus($id,$status)
    {
    	$item = Brand::findOrFail($id);
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
                $item['logo'] = getImage($item['logo']);
                return $item;
        });
        
        $items->setCollection($transformedItems);

        return $items;
    }
}