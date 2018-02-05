<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Order;
use App\Models\Service;

class OrderController extends Controller
{
    public function index(){
    	// $data["order"] = Service::with('order')->get();
    	$data["order"] = Order::with('service')
    	->with('client','client.biodata')
    	->with('technician','technician.biodata')
    	->get();
    	// dd($data["order"]);
    	return Response::json($data);
    	return view('order.index');
    }
}
