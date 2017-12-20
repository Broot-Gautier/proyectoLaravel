@extends('layouts.app')
@section('content')
 <div class="container">
    <h1> Perfiles que te siguen  </h1>
    Tus suscritos: <br>
    	@foreach ($suscritos as $suscrito)
                <td> {{ $suscrito }} </td> <br>
        @endforeach
 </div>
@endsection