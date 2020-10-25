<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contactmessage;
use App\Http\Resources\Panel as PanelResource;

class MessageController extends Controller
{

    function __construct()
    {
    	$this->middleware('auth:api');
    }

    private $pagination = 5;

    public function getMessages()
    {
    	$messages = Contactmessage::query();

    	if (request()->priority && request()->status) {
                // Filter by priority and status
                $priority = $this->getPriority(request()->priority);
                $status = $this->getStatus(request()->status);

                if(is_numeric($priority) && is_numeric($status)){
                    $messages = $messages->where(['priority'=>$priority,'viewed'=>$status]);
                }

            }
            elseif(request()->priority){
                $priority = $this->getPriority(request()->priority);
                if(is_numeric($priority)){
                    $messages = $messages->where('priority',$priority);
                }
            }
            elseif (request()->status) {
                $status = $this->getStatus(request()->status);

                if(is_numeric($status)){
                    $messages = $messages->where('viewed',$status);
                }
            }
            
            $order = request()->order ?? 'desc';
           	
           	$messages = $messages->orderBy('created_at',$order);
           	

            // Search 
            if(request()->search) {
                $keyword = request()->search;
                $messages = $messages->where(function ($query) use($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')->orderBy('id','desc');
                })->paginate($this->pagination);
            }
            else{

                $messages = $messages->paginate($this->pagination);
            }

    	return PanelResource::collection($messages);
    }

    public function destroy($id)
    {
    	$msg = Contactmessage::findOrFail($id);

    	if($msg->delete()){
    		return response()->json([
	            'success' => true
	        ], 201);
    	}

    	return ;
    }

    public function viewed($id)
    {
    	$msg = Contactmessage::findOrFail($id);
    	$msg->viewed = 1;

    	if ($msg->save()) {

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
         'unviewed' => 0,
         'viewed' => 1
        ];

        return $statusArr[$statusName];
    }
}
