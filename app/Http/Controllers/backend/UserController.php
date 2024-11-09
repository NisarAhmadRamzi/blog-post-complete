<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Role;

class UserController extends Controller
{
    public function index(){
        return view('backend.user.index')
        ->with('users',User::all())
        ->with('roles',Role::all());
    }

    public function create(){
        return view('backend.user.create')
        ->with('roles',Role::all());
    }

    public function store(Request $request){
        $fields = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4',
            'cpassword'=>'required|same:password',
            'profile'=>'nullable',
            'role' => 'required', // Ensure a role is provided
        ]);

        $user = new user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_role = $request->role;
        $user->save();

        $file = $request->file('profile');
        $path = $file ? $file->store('uploads', 'public') : null;

        $profile = new Profile();
        $profile->profile = $path;
        $profile->user_id = $user->id;
        $profile->save();

        session::flash('success','User created successfully!!!');
        return redirect()->route('user.index');
}
}
