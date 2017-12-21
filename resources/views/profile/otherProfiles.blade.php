@extends('layouts.app')
 @section('content')
 <div class="container">
    @if(Session::has('notice'))
       <div class="alert alert-success">
          {{ Session::get('notice') }}
       </div>
    @endif
    <h1> Perfil de  <?= $usuario->name; ?> </h1>
    <h2>mail usuario: <?= $usuario->email; ?></h2>
    <h2> Seguidores: <?= $cantidadSeguidores; ?></h2>
    <table class="table">
       <thead>
       <tr>
             <th style="width: 35%"> Posts </th>
             <th style="width: 10%"> </th>
             <th style="width: 10%"> </th>
             <th style="width: 10%"> </th>
          </tr>
       </thead>
       <tbody>
          @foreach ($posts as $post)
             <tr>
                <td> {{ $post->titulo }} </td>
                <td> {{ $post->descripcion }} </td>
                <td>
                    {!! link_to('comentar/'.$post->id .'/' .$usuario->id, 'Comentar post', ['class' => 'btn btn-primary']) !!} <br>
                </td>
             </tr>
          @endforeach
       </tbody>
    </table>
 </div>
 @endsection