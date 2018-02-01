<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(){

    	return view('material.index');
    }

    public function create(){

    	return view('material.create');
    }

    public function edit(){

    	return view('material.edit');
    }
}
