<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.users.list', [
            'data' => User::paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function show($id)
    {
        return view('admin.users.update', [
            'data' => User::find($id)
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ], [
            'email.unique' => 'The email address is already in use.',
        ]);
        User::updateOrCreate([
            'id' => $id
        ],$request->all());
        return redirect(route('user_list'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5'
        ], [
            'email.unique' => 'The email address is already in use.',
        ]);
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
            'status' => $request->status
        ]);
        return redirect(route('user_list'));
    }


    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect(route('user_list'));
    }
}
