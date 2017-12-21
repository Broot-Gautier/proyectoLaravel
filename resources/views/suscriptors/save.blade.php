@extends('layouts.app')
@section('content')
 <div class="container">
    <h1> Buscas a alguien? </h1>
    {!! Form::open(array('url' => 'suscriptors/' . $suscripcion->id, 'method' => $method)) !!}
      @foreach ($usuarios as $usuario)
             <tr>

                                        <div class="col-lg-6">
                                          <button type="button" class="btn btn-info btn-block">{{ $usuario->name }}</button>
                                        </div>
                <td>
                   {!! link_to('newsuscripcion/'.$usuario->id , 'Seguir!', ['class' => 'btn btn-primary btn-s']) !!}
                   {!! link_to('perfil/'.$usuario->id , 'Visita perfil', ['class' => 'btn btn-primary btn-s']) !!} <br>
                </td>
                <br>
             </tr>
          @endforeach
    {!! Form::close() !!}
 </div>
@endsection
