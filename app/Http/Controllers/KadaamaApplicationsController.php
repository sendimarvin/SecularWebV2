<?php

namespace App\Http\Controllers;

use App\Models\KadaamaApplication;
use Illuminate\Http\Request;

class KadaamaApplicationsController extends Controller
{
    //

    public function index(){

        return view("pages/kadaama/applications",[
            "kadaama_applications"=>KadaamaApplication::all()
        ]);
    }
}
