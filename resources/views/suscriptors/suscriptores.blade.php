@extends('layouts.app')
@section('content')
 <div class="container">
    <h1>    A los que sigues:    </h1>
    	@foreach ($suscritos as $suscrito)
                <td> {{ $suscrito }} </td> <br>
        @endforeach
 </div>
@endsection