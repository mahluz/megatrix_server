<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function index(){

    	return view('jasa.index');
    }

    public function create(){

    	return view('jasa.create');
    }

    public function edit(){

    	return view('jasa.edit');
    }
}
