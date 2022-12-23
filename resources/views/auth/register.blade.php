@extends('layouts.app') 
@section('titulo')
  Registrate en DevStagram
@endsection

@section('contenido')
<div class="md:flex md:justify-center ">
  <div class="md:w-4/12">
    <p>Imagen aqui</p>
  </div>
  <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
    <form>
      <div class="mb-5">
        <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
        <input type="text"  id="name" name="name" placeholder="Tú nombre" class="border p-3 w-full rounded-lg">
      </div>

      <div class="mb-5">
        <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">User name</label>
        <input type="text" id="username" name="username" placeholder="Tú nombre de usuario" class="border p-3 w-full rounded-lg">
      </div>


      <div class="mb-5">
        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
        <input type="email" id="email" name="email" placeholder="Tú nombre de usuario" class="border p-3 w-full rounded-lg">
      </div>

      <div class="mb-5">
        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password </label>
        <input type="password" id="password" name="password" placeholder="Password de registro" class="border p-3 w-full rounded-lg">

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