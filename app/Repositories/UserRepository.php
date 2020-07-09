<?php

namespace App\Repositories;


use App\Helpers\ExecuteRequest;

class UserRepository
{
    public function login($email, $password) {
        $passport_url = config('jwt.PASSPORT_URL');
        $endpoint_url = '/auth/login';
        $request_data  = json_encode([
            'email'    => $email,
            'password' => $password
        ]);
        #Call to Passport to get JWT
        $request_response = ExecuteRequest::executePostRequest($passport_url, $endpoint_url, $request_data);
        return $request_response;
    }
}
