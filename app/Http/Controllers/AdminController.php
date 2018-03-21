<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;

class AdminController extends Controller
{
    public function index(){
    	$data["admin"] = User::with('biodata')->where('role_id',1)->get();
    	return view('admin/index',$data);
    }

    public function delete(Request $request){
    	$db["admin"] = User::where('id',$request["id"])->delete();

    	return redirect('admin/admin');
    }

    public function create(Request $request){
    	return view('admin/create');
    }

    public function store(Request $request){
    	// dd($request);
		$db["admin"] = User::create([
			"role_id"=>1,
			"name"=>$request["name"],
			"email"=>$request["email"],
			"password"=>bcrypt($request["password"])
		]);

		$db["biodata"] = Biodata::create([
			"user_id"=>$db["admin"]->id,
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

		return redirect('admin/admin');
    }

    public function edit($id){
    	// dd($id);
    	$data["admin"] = User::with('biodata')->where('role_id',1)->where('id',$id)->first();
    	return view('admin/edit',$data);
    }

    public function update(Request $request){
    	$db["technician"] = User::where('id',$request["id"])->update([
			"role_id"=>1,
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

		return redirect('admin/admin');
    }

    public function biodata(Request $request){
    	$data["admin"] = User::with('biodata')->where('role_id',1)->where('id',$request["id"])->first();

		return view('admin/biodata',$data);
    }
}
