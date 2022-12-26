<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $req){
        //dd($req->get('username'));

        //validaciones 
        $this->validate($req,[
            'name' => ['required','max:30'],
            'username' => ['required','unique:users','min:3','max:20'],
            'email' => ['required','unique:users','email','max:60'],
            'password' => ['required','min:5']
        ]);
    }
}
