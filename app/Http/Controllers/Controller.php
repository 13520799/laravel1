<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $resp = [
        'code' => Response::HTTP_OK,
        'message' => '',
        'data' => [],
        'error' => [],
    ];
    
    public function resp($msg = null, $code = null, $data = [])
    {
        if (!empty($code)) {
            $this->resp['code'] = $code;
        }
        if (!empty($msg)) {
            $this->resp['message'] = $msg;
        }
        if ($this->resp['code'] == Response::HTTP_OK) {
            $this->resp['data'] = $data;
        } else {
            $this->resp['error'] = $data;
        }
    }
}
