@extends('layouts.app')
 @section('content')
 <div class="container">
    @if(Session::has('notice'))
       <div class="alert alert-success">
          {{ Session::get('notice') }}
       </div>
    @endif
    <h1> Tus posts </h1>
    <div class="row">
       <div class="col-lg-12">
          {!! link_to('posts/create', 'Crear', ['class' => 'btn btn-primary']) !!}
       </div>
    </div>
    <h2>nick usuario: <?= $usuario->name; ?></h2>
    <h2>mail usuario: <?= $usuario->email; ?></h2>
    <h2> Seguidores: <?= $cantidadSeguidores; ?></h2>
    <table class="table">
       <thead>
       <tr>
             <th style="width: 35%"> Título </th>
             <th style="width: 10%"> </th>
             <th style="width: 10%"> </th>
             <th style="width: 10%"> </th>
          </tr>
       </thead>
       <tbody>
          @foreach ($posts as $post)
             <tr>
                <td> {{ $post->titulo }} </td>
                <td>
                   {!! link_to('posts/'.$post->id, 'Ver', ['class' => 'btn btn-primary']) !!}
                </td>
                <td>
                   {!! link_to('posts/'.$post->id.'/edit', 'Editar', ['class' => 'btn btn-primary']) !!}
                </td>
                <td>
                   {!! Form::open(array('url' => 'posts/' . $post->id, 'method' => 'DELETE')) !!}
                      {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                   {!! Form::close() !!}
                </td>
             </tr>
          @endforeach
       </tbody>
    </table>
 </div>
 @endsection