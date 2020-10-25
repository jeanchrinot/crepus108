<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Contact;
use App\Http\Resources\Panel as PanelResource;
use Intervention\Image\Facades\Image;

class ContactController extends Controller
{

    function __construct()
    {
        $this->middleware('auth:api');
    }

    private $pagination = 5;

    public function getAllItems()
    {
        $items = Contact::all();

        return PanelResource::collection($items);
    }

    public function getItems()
    {
        $items = Contact::query();

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
        $item = Contact::findOrFail($id);

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
            'name' => ['required','string'],
            'email'=> ['required','email','regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'email2'=> ['nullable','email','regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'phone'=> ['required','regex:/^(\+|00){0,1}[0-9]{0,3}(\({1}[0-9]{1,3}\){1}){0,1}[0-9]{1,18}$/'],
            'phone2'=> ['nullable','regex:/^(\+|00){0,1}[0-9]{0,3}(\({1}[0-9]{1,3}\){1}){0,1}[0-9]{1,18}$/'],
            'address' => ['required'],
            'address2' => ''
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            // if ($request->file('image')) {

            //     $image = $request->file('image');

            //     $imagePath = $image->store('slider','public');

            //     $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200,600);

            //     $image->save();

            //     }

            $item = Contact::create([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'email2'=>$data['email2'],
                'phone'=>$data['phone'],
                'phone2'=>$data['phone2'],
                'address'=>$data['address'],
                'address2'=>$data['address2']
            ]);

            return new PanelResource($item);
        }
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();

        // return new PanelResource($request->file('image'));

        $validation = Validator::make($data,[ 
            'name' => ['required','string'],
            'email'=> ['required','email','regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'email2'=> ['nullable','email','regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'phone'=> ['required','regex:/^(\+|00){0,1}[0-9]{0,3}(\({1}[0-9]{1,3}\){1}){0,1}[0-9]{1,18}$/'],
            'phone2'=> ['nullable','regex:/^(\+|00){0,1}[0-9]{0,3}(\({1}[0-9]{1,3}\){1}){0,1}[0-9]{1,18}$/'],
            'address' => ['required'],
            'address2' => ''
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            // if ($request->file('image')) {

            //     $image = $request->file('image');

            //     $imagePath = $image->store('slider','public');

            //     $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200,600);

            //     $image->save();

            //     }

            $item = Contact::findOrFail($id);

            $item->update([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'email2'=>$data['email2'],
                'phone'=>$data['phone'],
                'phone2'=>$data['phone2'],
                'address'=>$data['address'],
                'address2'=>$data['address2']
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