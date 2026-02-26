<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('users.index',compact('data'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role
        ]);

        return redirect('/users');
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('users.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        $data = User::find($id);

        $data->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role
        ]);

        return redirect('/users');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect('/users');
    }
}