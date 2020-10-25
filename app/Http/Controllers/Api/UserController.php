<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\Panel as PanelResource;

class UserController extends Controller
{
    function __construct()
    {
    	$this->middleware('auth:api');
    }

    public function currentUser()
    {
    	$currentUser = Auth::user();

    	return new PanelResource($currentUser);
    }
}
