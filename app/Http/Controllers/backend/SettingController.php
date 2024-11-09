<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;


class SettingController extends Controller
{
    public function index(){
        return view('backend.setting.index')
        ->with('setting',Setting::first());
    }
    public function store(Request $request){
        
        $fields = $request->validate([
            'logo'=>'required',
            'facebook'=>'nullable|url',
            'twitter'=>'nullable|url',
            'email'=>'nullable|email',
            'phone'=>'nullable',
            'address'=>'nullable'
        ]);
        $file = $request->file('logo');
        $path = $file ? $file->store('uploads', 'public') : null;
         if ($path) {
            $fields['logo'] = $path;}
        Setting::where('id','1')->update($fields);
        session::flash('success','Setting updated successfully!!!');
        return redirect()->back();
    }
}
