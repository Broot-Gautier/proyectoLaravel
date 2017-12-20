@extends('layouts.app')
@section('content')
 <div class="container">
    <h1> Buscas a alguien? </h1>
    {!! Form::open(array('url' => 'suscriptors/' . $suscripcion->id, 'method' => $method)) !!}
      @foreach ($usuarios as $usuario)
             <tr>
                <button type="button" class="btn btn-info">
                    {{ $usuario->name }}
                </button>
                <td>
                   {!! link_to('newsuscripcion/'.$usuario->id , 'Suscribirse!', ['class' => 'btn btn-primary btn-xs']) !!} <br>
                </td>
             </tr>
          @endforeach
    {!! Form::close() !!}
 </div>
@endsection