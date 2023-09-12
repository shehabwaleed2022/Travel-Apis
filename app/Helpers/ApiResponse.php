<?php

namespace App\Helpers;

class ApiResponse
{
    public static function send($status = 200, $msg = '', $data = null)
    {
        $responseData = [
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        ];

        return response()->json($responseData, $status);
    }
}
