<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $req)
    {
        //Modificar el request
        $req->request->add(['username' => Str::slug($req->username)]);

        $this->validate($req, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter'],
        ]);


        if ($req->imagen) {
            $imagen = $req->file('imagen');
            $nombre_imagen = Str::uuid() . "." . $imagen->extension();
            $imagen_servidor = Image::make($imagen);
            $imagen_servidor->fit(1000, 1000);
            $imagenPath = public_path('perfiles') . '/' . $nombre_imagen;
            $imagen_servidor->save($imagenPath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $req->username;
        $usuario->imagen = $nombre_imagen ?? auth()->user()->imagen ??  null;

        $usuario->save();

        //Redireccionar al usuario

        return redirect()->route('post.index', $usuario->username);
    }
}
