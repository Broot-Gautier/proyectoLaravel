@extends('layouts.app')
@section('content')
 <div class="container">
    <h1>    A los que sigues:    </h1>
    	@foreach ($suscritos as $suscrito)
                <td> {{ $suscrito->name }} </td> 
                <td> {!! link_to('dejarseguir/'. $suscrito->id , 'Dejar de seguir', ['class' => 'btn btn-primary btn-xs']) !!} </td>
                <br>
        @endforeach
 </div>
@endsection