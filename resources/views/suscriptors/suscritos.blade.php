@extends('layouts.app')
@section('content')
 <div class="container">
    <h1> Perfiles que te siguen  </h1>
      @foreach ($suscritos as $suscrito)
                <td> {{ $suscrito->name }} </td>
                <td> {!! link_to('deletesuscripcion/'. $suscrito->id , 'Eliminar seguidor', ['class' => 'btn btn-primary btn-xs']) !!} </td>
                <br>
        @endforeach
 </div>
@endsection