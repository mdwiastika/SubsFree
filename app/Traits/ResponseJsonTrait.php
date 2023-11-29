<?php

namespace App\Traits;

trait ResponseJsonTrait
{
    public static function responseJson($code, $status, $message, $data)
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], 200);
    }
}
