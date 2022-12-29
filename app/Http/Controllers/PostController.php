<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {

        $posts  = Post::where('user_id', $user->id)->paginate(5);


        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public  function create()
    {
        return view('posts.create');
    }


    public  function store(Request $req)
    {
        $this->validate($req, [
            'titulo' => ['required', 'max:255'],
            'descripcion' => ['required'],
            'imagen' => ['required'],
        ]);


        Post::create([
            'titulo' => $req->titulo,
            'descripcion' => $req->descripcion,
            'imagen' => $req->imagen,
            'user_id' => auth()->user()->id
        ]);

        //Otra forma
        // $post = new Post;
        // $post->titulo = $req->titulo;
        // $post->descripcion = $req->descripcion;
        // $post->imagen = $req->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //Otra forma
        // $req->user()->posts()->create([
        //     'titulo' => $req->titulo,
        //     'descripcion' => $req->descripcion,
        //     'imagen' => $req->imagen,
        //     'user_id' => auth()->user()->id
        // ]);


        return redirect()->route('post.index', auth()->user()->username);
    }



    public function get()
    {
        $posts = Post::all();
        dd($posts);
    }


    public function show(User $user, Post $post)
    {

        return view('posts.show', [
            'post' =>  $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        Post::destroy($post->id);

        //Eliminar la imagen 
        $imagen_path = public_path('uploads/' . $post->imagen);

        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('post.index', auth()->user()->username);
    }
}
