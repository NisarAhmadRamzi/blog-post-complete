<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;


class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact.index')
       ;
    }

    public function send(Request $request){
        $fields = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'message'=>'required'
        ]);
    }
}
