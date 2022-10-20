<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{
    public function apiResponse($data = null,$message = null,$status = null)
    {
          $arr = [
                'data'       => $data,
                'messages'   =>  $message,
                'status'     =>  $status
        ];
        return response($arr,200);

    }
}
