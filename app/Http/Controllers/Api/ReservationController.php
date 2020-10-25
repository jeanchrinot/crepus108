<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Http\Resources\Panel as PanelResource;

class ReservationController extends Controller
{

    function __construct()
    {
    	$this->middleware('auth:api');
    }

    private $pagination = 5;

    public function getItems()
    {
    	$items = Reservation::query();

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

    	return PanelResource::collection($items);
    }

    public function destroy($id)
    {
    	$item = Reservation::findOrFail($id);

    	if($item->delete()){
    		return response()->json([
	            'success' => true
	        ], 201);
    	}

    	return ;
    }

    public function updateStatus($id,$status)
    {
    	$item = Reservation::findOrFail($id);
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
         'pending' => 0,
         'confirmed' => 1,
         'done'=>2,
         'canceled'=>3
        ];

        return $statusArr[$statusName];
    }
}
