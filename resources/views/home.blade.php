@extends('layouts.app')
@section('titulo')
    Página principal
@endsection

@section('contenido')
    <div class="flex-col  flex justify-center items-center my-24 ">
        <p>Personas de GBP</p>
        <div class=" flex  justify-center overflow-x-auto mt-5 " style="max-width: 600px !important;">
            @foreach ($users as $user)
                @if ($user->id !== auth()->user()->id)
                    <a href="{{ route('post.index', $user->username) }}" class="mx-3 flex flex-col items-center shadow p-2">
                        <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}"
                            alt="{{ auth()->user()->username }}" class="rounded-lg" width="50px">
                        <p class="text-sm">{{ $user->username }}</p>
                    </a>
                @endif
            @endforeach

        </div>
    </div>
    @if ($posts->count())
        <div class="flex flex-col justify-center items-center w-100">
            @foreach ($posts as $post)
                <div class=" my-5 shadow">
                    <a href="{{ route('post.index', $post->user->username) }}" class="font-bold px-2">
                        {{ $post->user->username }} </a>
                    <p class="text-sm text-gray-500 px-2 mb-2">
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                    <a
                        href="{{ route('posts.show', [
                            'post' => $post,
                            'user' => $post->user,
                        ]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}"
                            width="500px">
                    </a>

                    <div class="flex items-center gap-2">

                        @if ($post->checkLike(auth()->user()))
                            <form action="{{ route('posts.likes.destroy', $post) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="my-4">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    </button>
                                </div>

                            </form>
                        @else
                            <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                                @csrf
                                <div class="my-4">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    </button>
                                </div>

                            </form>
                        @endif
                        <p class="font-bold">{{ $post->likes->count() }} <span class="font-normal">Likes</span></p>

                    </div>

                </div>
            @endforeach
        </div>



        <div class="my-10">
            {{ $posts->links() }}
        </div>
    @else
        <h1 class="text-center text-gray-500">No Hay publicaciones</h1>
    @endif



@endsection
