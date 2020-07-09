<?php


namespace App\Helpers;



class ResponseFormat
{
    const ERROR_CODE = 0;
    /**
     * @param $status_code
     * @param string $message
     * @param $data
     * @param int $http_code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function response($status_code, $message = '', $data, $http_code = 200) {
        return response()->json([
            'status_code' => $status_code,
            'message'     => $message,
            'data'        => $data
        ], $http_code);
    }
}
