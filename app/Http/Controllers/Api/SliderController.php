<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Slider;
use App\Http\Resources\Panel as PanelResource;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{

    function __construct()
    {
        $this->middleware('auth:api');
    }

    private $pagination = 5;

    public function getAllItems()
    {
        $items = Slider::all();

        return PanelResource::collection($items);
    }

    public function getItems()
    {
        $items = Slider::query();

            // if (request()->status) {
            //     $status = $this->getStatus(request()->status);

            //     if(is_numeric($status)){
            //         $items = $items->where('status',$status);
            //     }
            // }
            
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
        $item = Slider::findOrFail($id);

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
            'title_1' => ['required','string'],
            'title_2' => ['nullable','string'],
            'button_1_name' => ['nullable','string'],
            'button_1_url' => '',
            'description' => '',
            'image'=>'required|image'
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            if ($request->file('image')) {

                $image = $request->file('image');

                $imagePath = $image->store('slider','public');

                $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200,600);

                $image->save();

                }

            $item = Slider::create([
                'title_1'=>$data['title_1'],
                'title_2'=>$data['title_2'],
                'button_1_name'=>$data['button_1_name'],
                'button_1_url'=>$data['button_1_url'],
                'description'=>$data['description'],
                'image'=>$imagePath ?? ''
            ]);

            $item->image = getImage($item->image);

            return new PanelResource($item);
        }
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();

        // return new PanelResource($request->file('image'));

        $validation = Validator::make($data,[ 
            'title_1' => ['required','string'],
            'title_2' => ['nullable','string'],
            'button_1_name' => ['nullable','string'],
            'button_1_url' => '',
            'description' => '',
            'image'=>''
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            if ($request->file('image')) {

                $image = $request->file('image');

                $imagePath = $image->store('slider','public');

                $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200,600);

                $image->save();

                }

            $item = Slider::findOrFail($id);

            $item->update([
                'title_1'=>$data['title_1'],
                'title_2'=>$data['title_2'],
                'button_1_name'=>$data['button_1_name'],
                'button_1_url'=>$data['button_1_url'],
                'description'=>$data['description'],
                'image'=>$imagePath ?? $item->image
            ]);
            
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