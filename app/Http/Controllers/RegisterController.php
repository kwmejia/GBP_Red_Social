<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $req)
    {
        //dd($req->get('username'));

        //Modificar el request
        $req->request->add(['username' => Str::slug($req->username)]);

        //validaciones 
        $this->validate($req, [
            'name' => ['required', 'max:30'],
            'username' => ['required', 'unique:users', 'min:3', 'max:20'],
            'email' => ['required', 'unique:users', 'email', 'max:60'],
            'password' => ['required', 'min:5']
        ]);


        User::create([
            'name' => $req->name,
            'username' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);


        //Autenticar usuario  auth()->attempt($req->only('email','password'))

        auth()->attempt([
            'email' => $req->email,
            'password' => $req->password
        ]);

        //Redireccionar
        return redirect()->route('post.index', auth()->user()->username);
    }
}
