<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Condition;
use App\Http\Resources\Panel as PanelResource;
use Intervention\Image\Facades\Image;

class ConditionController extends Controller
{

    function __construct()
    {
        $this->middleware('auth:api');
    }

    private $pagination = 5;

    public function getAllItems()
    {
        $items = Condition::all();

        return PanelResource::collection($items);
    }

    public function getItems()
    {
        $item = Condition::findOrFail(1);

        return new PanelResource($item);
    }

    public function destroy($id)
    {
        $item = Condition::findOrFail($id);

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
            'title' => ['required','string'],
            'conditions' => ['required']
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            $item = Condition::create([
                'title'=>$data['title'],
                'conditions'=>$data['conditions']
            ]);

            return new PanelResource($item);
        }
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();

        // return new PanelResource($request->file('image'));

        $validation = Validator::make($data,[ 
            'title' => ['required','string'],
            'conditions' => ['required']
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            $item = Condition::findOrFail($id);

            $item->update([
                'title'=>$data['title'],
                'conditions'=>$data['conditions']
            ]);

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