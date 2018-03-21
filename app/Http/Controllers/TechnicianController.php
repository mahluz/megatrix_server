<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;

class TechnicianController extends Controller
{
    public function index(){
    	$data["technician"] = User::with('biodata')->where('role_id',3)->get();
    	return view('technician/index',$data);
    }

    public function delete(Request $request){
    	$db["technician"] = User::where('id',$request["id"])->delete();

    	return redirect('admin/technician');
    }

    public function create(Request $request){
    	return view('technician/create');
    }

    public function store(Request $request){
    	// dd($request);
		$db["technician"] = User::create([
			"role_id"=>3,
			"name"=>$request["name"],
			"email"=>$request["email"],
			"password"=>bcrypt($request["password"])
		]);

		$db["biodata"] = Biodata::create([
			"user_id"=>$db["technician"]->id,
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

		return redirect('admin/technician');
    }

    public function edit($id){
    	// dd($id);
    	$data["technician"] = User::with('biodata')->where('role_id',3)->where('id',$id)->first();
    	return view('technician/edit',$data);
    }

    public function update(Request $request){
    	$db["technician"] = User::where('id',$request["id"])->update([
			"role_id"=>3,
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

		return redirect('admin/technician');
    }

    public function biodata(Request $request){
    	$data["technician"] = User::with('biodata')->where('role_id',3)->where('id',$request["id"])->first();

		return view('technician/biodata',$data);
    }
}
