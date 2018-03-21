<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;

class ClientController extends Controller
{
    public function index(){
    	$data["client"] = User::with('biodata')->where('role_id',2)->get();
    	return view('client/index',$data);
    }

    public function delete(Request $request){
    	$db["client"] = User::where('id',$request["id"])->delete();

    	return redirect('admin/client');
    }

    public function create(Request $request){
    	return view('client/create');
    }

    public function store(Request $request){
    	// dd($request);
		$db["client"] = User::create([
			"role_id"=>2,
			"name"=>$request["name"],
			"email"=>$request["email"],
			"password"=>bcrypt($request["password"])
		]);

		$db["biodata"] = Biodata::create([
			"user_id"=>$db["client"]->id,
			"gender"=>$request["gender"],
			"cp"=>$request["cp"],
			"date_of_birth"=>$request["date_of_birth"],
			"province"=>$request["province"],
			"regency"=>$request["regency"],
			"district"=>$request["district"],
			"village"=>$request["village"],
			"home_address"=>$request["home_address"],
			"last_education"=>$request["last_education"],
			"profession"=>$request["profession"],
			"skill"=>$request["skill"]
		]);

		return redirect('client/client');
    }

    public function edit($id){
    	// dd($id);
    	$data["client"] = User::with('biodata')->where('role_id',2)->where('id',$id)->first();
    	return view('client/edit',$data);
    }

    public function update(Request $request){
    	$db["technician"] = User::where('id',$request["id"])->update([
			"role_id"=>2,
			"name"=>$request["name"],
			"email"=>$request["email"],
			"password"=>bcrypt($request["password"])
		]);

		$db["biodata"] = Biodata::where('id',$request["id"])->update([
			"gender"=>$request["gender"],
			"cp"=>$request["cp"],
			"date_of_birth"=>$request["date_of_birth"],
			"province"=>$request["province"],
			"regency"=>$request["regency"],
			"district"=>$request["district"],
			"village"=>$request["village"],
			"home_address"=>$request["home_address"],
			"last_education"=>$request["last_education"],
			"profession"=>$request["profession"],
			"skill"=>$request["skill"]
		]);

		return redirect('admin/client');
    }

    public function biodata(Request $request){
    	$data["client"] = User::with('biodata')->where('role_id',2)->where('id',$request["id"])->first();

		return view('client/biodata',$data);
    }
}
