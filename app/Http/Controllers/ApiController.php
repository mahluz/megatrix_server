<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use JWTAuth;
use JWTAuthException;
use App\Models\User;
use App\Models\Service;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class ApiController extends Controller
{
    public function __construct(){
    	$this->user = new User;
    }

    public function login(Request $request){
    	// return "yey";
    	// dd($request);
    	$credentials = $request->only('email','password');
    	$token = null;

    	try{
    		if(!$token = JWTAuth::attempt($credentials)){
    			return Response::json([
    				"response"=>'error',
    				"message"=>'invalid_email_or_password',
    			]);
    		}
    	}catch(JWTAuthException $e){
    		return Response::json([
    			'response'=>'error',
    			"message"=>'failed_to_create_token',
    		]);
    	}

    	return Response::json([
    		"response"=>'success',
    		"result"=>[
    			'token' => $token,
    		],
    	]);
    }

    public function getAuthUser(Request $request){
    	$user = JWTAuth::toUser($request->token);

    	return Response::json([
    		"result"=> $user
    	]);
    }

    public function getService(Request $request){
        // $service = JWTAuth::toUser($request->token);
        $data = Service::get();

        return Response::json([
            "result"=>$data
        ]);
    }

    public function request(Request $request){
        // $service = JWTAuth::toUser($request->token);
        return Response::json($request);
    }

    public function getProvince(Request $request){
        $data = Province::get();

        return Response::json([
            "result"=>$data
        ]);
    }

    public function getRegency(Request $request){
        $data = Province::with('regencies')->where('name',$request["province"])->first();

        return Response::json([
            "result"=>$data["regencies"]
        ]);
    }

    public function getDistrict(Request $request){
        $data = Regency::with('districts')->where('name',$request["regency"])->first();

        return Response::json([
            "result"=>$data
        ]);
    }

}
