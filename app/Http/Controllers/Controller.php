<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function apiResponse($status, $message = null, $data = null, $code = 422)
    {
        return response()->json(
            ['status' => $status, 'code' => $code, 'message' => $message, 'data' => $data]
        );
	}
	
	public function sendResponse($status, $message = null, $data = null, $code = 200)
    {
        return response()->json(
            ['status' => $status, 'code' => $code, 'message' => $message, 'data' => $data]
        );
    }
}
