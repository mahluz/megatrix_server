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

    public function getTechnician(Request $request){
        // global $request;
        $data = User::join('biodatas','users.id','=','biodatas.user_id')
        ->where('role_id',3)
        ->where('province',$request["province"])
        ->where('regency',$request["regency"])
        ->where('district',$request["district"])
        ->where('village',$request["village"])
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

        return redirect('admin/order');
    }
}
