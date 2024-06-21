<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param Array|Object|Int|null $results
     * @param String|Array|null $message
     * @param Int $code
     * 
     * @return [type]
     */
    public function responseSuccess(Array|Object|Int $results = null, String|Array $message = null, Int $code = 200)
    {
        $data = [
            "status" => true,
            "message" => is_string($message) ? [$message] : $message,
            "data" => $results,
        ];
        return response()->json($data, $code);
    }
}
