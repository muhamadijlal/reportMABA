<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index() {
        return view('layouts.register');
    }

    public function store(Request $request) {

        $request->validate([
            'name'           => ['required'],
            'email'          => ['required','unique:users,email'],
            'password'       => ['required','min:6','max:12'],
            'retypePassword' => ['required','min:6','max:12', 'confirmed']
        ]);

        $user = new User;

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->name     = $request->name;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect('/signin')->withSuccess('Your account has been created!');
    }
}
