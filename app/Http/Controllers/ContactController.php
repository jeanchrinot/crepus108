<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Models\Contact;
use App\Models\Contactmessage;
use App\Models\Reservation;
use App\Models\Newsletter;
use App\Http\Resources\Contact as ContactResource;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function index()
    {
    	// get contact
    	$contact = Contact::find(1);

    	// show contact us page
    	return view('contact',compact('contact'));
    }

    public function test()
    {
    	$services = \App\Models\Service::paginate(5);

    	return ContactResource::collection($services);
    }

    public function store(Request $request)
    {
        // Store contact us form data

        $data = (array) $request['body'];


        $validation = Validator::make($data,[ 
            'name' => ['required','string','max:100','regex:/^[A-Za-z\s\-_]+$/'],
            'email'=> ['nullable','email','regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'phone'=> ['required','regex:/^(\+|00){0,1}[0-9]{0,3}(\({1}[0-9]{1,3}\){1}){0,1}[0-9]{1,18}$/'],
            'subject'=> 'required|string',
            'message'=>'required'
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            Contactmessage::create($data);

            return new ContactResource(['success'=>true]);
        }
    }

     public function reservation(Request $request)
    {
        // Store reservation form data

        $data = (array) $request['body'];


        $validation = Validator::make($data,[ 
            'name' => ['required','string','max:100','regex:/^[A-Za-z\s\-_]+$/'],
            'email'=> ['nullable','email','regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/'],
            'phone'=> ['required','regex:/^(\+|00){0,1}[0-9]{0,3}(\({1}[0-9]{1,3}\){1}){0,1}[0-9]{1,18}$/'],
            'service'=> 'required|numeric',
            'rs_date'=>'required|date',
            'rs_time'=>'required|date_format:H:i',
            'note'=>''
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            // Check if date and time is available

            $rs = Reservation::where(['rs_date'=>$data['rs_date'],'rs_time'=>$data['rs_time']])->count();

            if ($rs>0) {
                // Date and time not available

                $errors = new MessageBag;
                $errors->add('error','La <<date et heure>> choisie n\'est pas disponible.');

                return $errors->toJson();
            }

            Reservation::create($data);

            return new ContactResource(['success'=>'true']);
        }
    }

    public function getRS()
    {
        $rs = Reservation::where('status','<=',1)->where('rs_date', '>', Carbon::now())->get(['id','rs_date','rs_time']);

        return ContactResource::collection($rs);
    }

      public function newsletter(Request $request)
    {
        // Store contact us form data

        $data = (array) $request['body'];


        $validation = Validator::make($data,[ 
            'email'=> ['required','email','regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/']
        ]);

        if($validation->fails()){

            $errors = $validation->errors();
            return $errors->toJson();

        }else{

            Newsletter::create($data);

            return new ContactResource(['success'=>'true']);
        }
    }
}
