@extends('layouts.app') 
@section('titulo')
  Registrate en DevStagram
@endsection

@section('contenido')
<div class="md:flex md:justify-center md:gap-10 ">
  <div class="md:w-6/12 p-5">
   <img src="{{ asset('img/registrar.jpg') }}" alt="regristrar">
  </div>
  <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="mb-5">
        <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
        <input type="text"  id="name" name="name" placeholder="Tú nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500             
        @enderror"
        value="{{old('name')}}">
        @error('name')
            <p class="bg-red-500 text-white my-2 text-sm p-2 text-center rounded-lg">{{ $message }}<p>
        @enderror
      </div>

      <div class="mb-5">
        <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">User name</label>
        <input type="text" id="username" name="username" placeholder="Tú nombre de usuario" class="border p-3 w-full rounded-lg">
        @error('username')
        <p class="bg-red-500 text-white my-2 text-sm p-2 text-center rounded-lg">{{ $message }}<p>
    @enderror
      </div>


      <div class="mb-5">
        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
        <input type="email" id="email" name="email" placeholder="Tú nombre de usuario" class="border p-3 w-full rounded-lg">
        @error('email')
            <p class="bg-red-500 text-white my-2 text-sm p-2 text-center rounded-lg">{{ $message }}<p>
        @enderror
      </div>

      <div class="mb-5">
        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password </label>
        <input type="password" id="password" name="password" placeholder="Password de registro" class="border p-3 w-full rounded-lg">
        @error('password')
        <p class="bg-red-500 text-white my-2 text-sm p-2 text-center rounded-lg">{{ $message }}<p>
    @enderror
      </div>



      <div class="mb-5">
        <label for="password_confimation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir password </label>
        <input type="password" id="password_confimation" name="password_confimation" placeholder="Repite tu password" class="border p-3 w-full rounded-lg">

      </div>

      <input type="submit" value="Crear cuenta"
      class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
    </form>
</div>

@endsection