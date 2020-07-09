<?php


namespace App\Helpers;


use GuzzleHttp\Client;

class ExecuteRequest
{
    /**
     * Function execute API Initiate Payment
     * @param $baseUrl
     * @param $endPoint
     * @param $data
     * @return string (Response create QR code from Grab)
     */
    public static function executePostRequest($base_url, $end_point, $data)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $base_url,
            'headers'  => [
                'Content-Type'  => 'application/json',
            ]
        ]);
        $res = $client->post($end_point, [
            'body' => $data
        ]);

        return $res->getBody()->getContents();
    }
}
