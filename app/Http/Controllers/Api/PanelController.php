<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Contactmessage;
use App\Http\Resources\Panel as PanelResource;

class PanelController extends Controller
{

    function __construct()
    {
    	$this->middleware('auth:api');
    }

    public function stats()
    {       
            // Messages stats
            $msg = Contactmessage::all();
    	    $msgTotal = $msg->count();
            $msgUnviewed = $msg->where('viewed',0)->count();

            // Reservations stats
            $rsv = Reservation::all();
            $rsvTotal = $rsv->count();
            $rsvPending = $rsv->where('status',0)->count();
            $rsvDone = $rsv->where('status',2)->count();
            $rsvCanceled = $rsv->where('status',3)->count();

            $stats = [
                'messages'=>[
                    'total'=>$msgTotal,
                    'unviewed'=>$msgUnviewed
                ],
                'reservations'=>[
                    'total'=>$rsvTotal,
                    'pending'=>$rsvPending,
                    'done'=>$rsvDone,
                    'canceled'=>$rsvCanceled
                ]
              ];

    	return PanelResource::collection($stats);
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
