<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;

class OrderController extends Controller
{
    public function index(){
    	// $data["order"] = Service::with('order')->get();
    	$data["order"] = Order::with('service')
    	->with('client','client.biodata')
    	->with('technician','technician.biodata')
    	->with('order_materials','order_materials.material')
    	->get();
    	// dd($data["order"]);
    	// return Response::json($data);
    	return view('order.index',$data);
    }

    public function delete(Request $request){
        $db = Order::where('id',$request["id"])->delete();

        return redirect('admin/order');
    }

    public function getTechnician(Request $request){
        // global $request;
        $data = User::join('biodatas','users.id','=','biodatas.user_id')
        ->where('role_id',3)
        ->where('status','free')
        ->where('province',$request["province"])
        ->where('regency',$request["regency"])
        ->where('district',$request["district"])
        ->get();

        return Response::json($data);
    }

    public function setTechnician(Request $request){
        // dd($request);
        $db["order"] = Order::where('id',$request["order_id"])
        ->update([
            "technician_id"=>$request["technician_id"],
            "status"=>"on process"
        ]); 

        $db["technician"] = User::where('id',$request["technician_id"])
        ->update([
            "status"=>"on work"
        ]);

        return redirect('admin/order');
    }

    public function technicianDetail(Request $request){
        $data["technician"] = User::with('biodata')->where('id',$request["technician_id"])->first();
        // dd($data);
        return view('order.technicianDetail',$data);
    }
}
