<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use JWTAuth;
use JWTAuthException;
use App\Models\User;
use App\Models\Biodata;
use App\Models\Order;
use App\Models\OrderMaterial;
use App\Models\Material;
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
            "result"=>$data["districts"]
        ]);
    }

    public function getVillage(Request $request){
        $data = District::with('villages')->where('name',$request["district"])->first();

        return Response::json([
            "result"=>$data["villages"]
        ]);
    }

    public function onOrder(Request $request){
        $data["user"] = Biodata::where('user_id',$request["user"]["id"])->update([
            "province"=>$request["order"]["province"],
            "regency"=>$request["order"]["regency"],
            "district"=>$request["order"]["district"],
            "village"=>$request["order"]["village"],
            "home_address"=>$request["order"]["address"]
        ]);
        $data["order"] = Order::create([
            "service_id"=>$request["order"]["service"],
            "client_id"=>$request["user"]["id"]
        ]);
        return Response::json([
            "result"=>$data
        ]);
    }

    public function getOrder(Request $request){
        $data["order"] = Order::with('service')
        ->with('technician')
        ->with('order_materials','order_materials.material')
        ->where('client_id',$request["user"]["id"])
        ->where('status','requested')
        ->orWhere('status','on process')
        ->get();
        return Response::json([
            "items"=>$data["order"]
        ]);
    }

    public function completeOrder(Request $request){
        $db["order_status"] = Order::where('id',$request["order"])->first();

        if($db["order_status"]->status == "on process"){
            $db["technician"] = User::where('id',$db["order_status"]->technician_id)
                                ->update([
                                    "status"=>"free"
                                ]);
            $db["client"] = User::where('id',$db["order_status"]->client_id)
                                ->update([
                                    "status"=>"free"
                                ]);
            $db["order"] = Order::where('id',$request["order"])
                        ->update([
                            "status"=>"complete"
                        ]);
            return Response::json([
                "result"=>$db
            ]);
        } else {
            return Response::json([
                "result"=>"gagal"
            ]);
        }

    }

    public function getNearOrder(Request $request){

        $currentUser = User::with('biodata')
        ->with('order','order.client')
        ->where('id',$request["user"]["id"])->first();

        $data["order"] = Order::with('client','client.biodata')
        ->whereHas('client.biodata',function($query) use ($currentUser){
            $query->where('district',$currentUser["biodata"]["province"]);
        })
        ->where('status','requested')
        ->orWhere('status','on process')
        ->get();

        return Response::json([
            "technician"=>$currentUser,
            "headerImage"=>"assets/images/background/14.jpg",
            "toolBarTitle"=>"Parallax-title",
            "title"=> "My Status ".$currentUser["status"],
            "iconLike"=>"icon-thumb-up",
            "iconFavorite"=>"icon-heart",
            "iconShare"=>"icon-share-variant",
            "items"=>$data["order"]
        ]);
    }

    public function setTechnician(Request $request){

        $db["status"] = User::where('id',$request["user"]["id"])->first();

        if($db["status"]["status"] == "free"){
            $db["order"] = Order::where('id',$request["order"])
            ->update([
                "technician_id"=>$request["user"]["id"],
                "status"=>"on process"
            ]); 

            $db["technician"] = User::where('id',$request["user"]["id"])
            ->update([
                "status"=>"on work"
            ]);

            return Response::json([
                "result"=>$db
            ]);
        } else {
            return Response::json([
                "result"=>"error"
            ]);
        }

    }

    public function getOrderMaterial(Request $request){
        $db["order_materials"] = OrderMaterial::with('material')
                                ->where('order_id',$request["order"]["id"])->get();

        return Response::json($db["order_materials"]);
    }

    public function addMaterial(Request $request){
        $db["order_material"] = OrderMaterial::create([
            "order_id"=>$request["order"]["id"],
            "material_id"=>$request["material"]
        ]);

        return Response::json([
            "result"=>$db["order_material"]
        ]);
    }

    public function getMaterial(Request $request){
        $db["material"] = Material::get();

        return Response::json([
            "result"=>$db["material"]
        ]);
    }

    public function removeOrderMaterial(Request $request){
        $db["order_material"] = OrderMaterial::where('id',$request["orderMaterial"])->delete();

        return Response::json([
            "result"=>$db["order_material"]
        ]);
    }

    public function cancelOrder(Request $request){

        $db["order"] = Order::where('id',$request["order"])->first();

        if($db["order"]->status == "requested"){
            $db["cancelOrder"] = Order::where('id',$request["order"])->delete();
            return Response::json([
                "result"=>$request["order"]
            ]);
        } else {
            return Response::json([
                "result"=>"gagal"
            ]);
        }
    }

    public function registerClient(Request $request){

        $db["client"] = User::create([
            "role_id"=>2,
            "name"=>$request["credential"]["name"],
            "email"=>$request["credential"]["email"],
            "password"=>bcrypt($request["credential"]["password"])
        ]);

        $db["client_biodata"] = Biodata::create([
            "user_id"=>$db["client"]->id,
            "gender"=>$request["credential"]["gender"],
            "cp"=>$request["credential"]["cp"],
            "date_of_birth"=>$request["credential"]["date_of_birth"],
            "province"=>$request["credential"]["province"],
            "regency"=>$request["credential"]["regency"],
            "district"=>$request["credential"]["district"],
            "village"=>$request["credential"]["village"],
            "home_address"=>$request["credential"]["home_address"],
            "last_education"=>$request["credential"]["last_education"],
            "profession"=>$request["credential"]["profession"],
            "skill"=>$request["credential"]["skill"]
        ]);

        return Response::json([
            "result"=>$db
        ]);
    }

    public function registerTechnician(Request $request){

        $db["client"] = User::create([
            "role_id"=>3,
            "name"=>$request["credential"]["name"],
            "email"=>$request["credential"]["email"],
            "password"=>bcrypt($request["credential"]["password"])
        ]);

        $db["client_biodata"] = Biodata::create([
            "user_id"=>$db["client"]->id,
            "gender"=>$request["credential"]["gender"],
            "cp"=>$request["credential"]["cp"],
            "date_of_birth"=>$request["credential"]["date_of_birth"],
            "province"=>$request["credential"]["province"],
            "regency"=>$request["credential"]["regency"],
            "district"=>$request["credential"]["district"],
            "village"=>$request["credential"]["village"],
            "home_address"=>$request["credential"]["home_address"],
            "last_education"=>$request["credential"]["last_education"],
            "profession"=>$request["credential"]["profession"],
            "skill"=>$request["credential"]["skill"]
        ]);

        return Response::json([
            "result"=>$db
        ]);
    }

    public function getCurrentJobTechnician(Request $request){
        $db["technician"] = User::where('id',$request["technician"]["id"])->first();

        if($db["technician"]->status == "on work"){
            $db["order"] = Order::where('technician_id',$db["technician"]->id)
                                    ->where('status','on process')
                                    ->first();
            return Response::json([
                "result"=>$db
            ]);
        } else {
            return Response::json([
                "result"=>"gagal"
            ]);
        }
    }

    public function getUserBiodata(Request $request){
        $currentUser = User::with('biodata')
        ->where('id',$request["user"]["id"])->first();

        return Response::json($currentUser);
    }

}
