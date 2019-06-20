<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function index()
    {
        // if (Auth::check()) {
        //     echo "Nguoi dung da dang nhap he thong";
        // }

    	$this->resp(Auth::guard()->user(), Response::HTTP_OK);
        return response()->json($this->resp, Response::HTTP_OK);
    }
}
