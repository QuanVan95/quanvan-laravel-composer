<?php

namespace App\Http\Controllers;


use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormat;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    const ERROR_CODE = 0;
    private $request;
    private $userRepository;
    public function __construct(Request $request, UserRepository $userRepository)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        $validated_data = Validator::make($this->request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validated_data->fails()) {
            $errors = $validated_data->errors();
            foreach ($errors->all() as $error) {
                return ResponseFormat::response(self::ERROR_CODE,'Invalid data', $error);
            }
        }

        $email    = $this->request->get('email');
        $password = $this->request->get('password');
        $request_response = $this->userRepository->login($email, $password);

        if (empty($request_response)) {
            return ResponseFormat::response(self::ERROR_CODE, 'Cannot execute API');
        }

        $reponse_data = json_decode($request_response,true);

        return ResponseFormat::response($reponse_data['code'], $reponse_data['message'], $reponse_data['data']);
    }

    public function checkAuthentication() {
        return "Access successfully";
    }
}
