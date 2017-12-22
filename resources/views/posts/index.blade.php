@extends('layouts.app')
 @section('content')
 <div class="container">
    @if(Session::has('notice'))
       <div class="alert alert-success">
          {{ Session::get('notice') }}
       </div>
    @endif


    <div class="panel panel-primary">
      <div class="panel-heading">
        <h1 class="panel-title">Perfil de  <?= $usuario->name; ?></h1>
      </div>
      <button class="btn btn-primary" type="button">
          <?= $usuario->email; ?> <span class="badge"></span>
        </button> <br>
      <button class="btn btn-primary" type="button">
          Seguidores <span class="badge"><?= $cantidadSeguidores; ?></span>
        </button>
      </div>
    </div>
      <p align="center">
          {!! link_to('posts/create', 'Crear nueva publicacion', ['class' => 'btn btn-primary']) !!}
     </p>
    <table class="table">
       <thead>
       <tr>
            <th style="width: 5%"> </th>
             <th style="width: 25%"> Título </th>
             <th style="width: 15%"> Descripcion </th>
             <th style="width: 15%"> Comentarios </th>
             <th style="width: 5%"> </th>
             <th style="width: 5%"> </th>
             <th style="width: 5%"> </th>
          </tr>
       </thead>
       <tbody>
        @foreach ($resultados as $post1)
             <tr>
                <td> {!! link_to('comentar/'.$post1['id'] .'/' .$usuario->id, 'Comentar post', ['class' => 'btn btn-primary']) !!} </td>
                <td> {{ $post1['titulo'] }} </td>
                <td> {{ $post1['descripcion'] }} </td>
                <td>
                  @foreach ($post1['comentario'] as $com1=>$uno)
                  {{ $uno }}<br>
                  @endforeach
                </td>
                <td>
                   {!! link_to('posts/'.$post1['id'], 'Ver', ['class' => 'btn btn-primary']) !!}
                </td>
                <td>
                   {!! link_to('posts/'.$post1['id'].'/edit', 'Editar', ['class' => 'btn btn-primary']) !!}
                </td>
                <td>
                   {!! Form::open(array('url' => 'posts/' . $post1['id'] , 'method' => 'DELETE')) !!}
                      {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                   {!! Form::close() !!}
                </td>
             </tr>
          @endforeach
          </tbody>
    </table>
 </div>
 @endsection