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
            'email'          => ['required','email:dns'],
            'password'       => ['required','min:6','max:12','same:retypePassword'],
            'retypePassword' => ['required','min:6','max:12']
        ]);

        $user = new User;

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->name     = $request->name;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect('/');
    }
}
