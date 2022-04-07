<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class ApiBaseController extends Controller
{


    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public $obj;
    public $unauth;
    public $array_routes;

    public function __construct()
    {
        if (request()->header('lang')) {
            app()->setLocale(request()->header('lang'));
        }

        $this->obj    = json_decode('{}');
        $this->unauth = $this->obj;
        $this->array_routes = [
            'api.getCategories',

        ];
    }


    public function sendResponse($result=[], $message='', $validator , $success = true, $statusCode=404)
    {
//dd($result);
    	$response = [
            'success'   => $success,
            'data'      => $result ,
            'message'   => $message,
            'validator' => $validator,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($result,$message, $code = 404, $success = false) // code 422
    {
    	$response = [
            'success'   => $success,
            'data'      => $result,
            'message'   => $message,
        ];

        return response()->json($response, $code);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendValidatorr($result,$message, $code = 404, $success = false , $validatorr) // code 422
    {
        $response = [
            'success'     => $success,
            'data'        => $result,
            'message'     => $message,
            'validator'   => $validatorr,
        ];

        return response()->json($response, $code);
    }
    public function UserWrap($user){
        if (true) {
            $token = $user->createToken($user->email . ' Access Token')->accessToken;

            $response = [
                'user'  => $user,
                'token' => $token,
            ];
            $msg = "Login successfully.";
        } else {
            $response = [];
            $msg = "Your account is suspended.";
        }

        return $this->sendResponse($response, $msg,$this->obj,true,200);
    }
}
