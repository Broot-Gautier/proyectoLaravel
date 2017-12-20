@extends('layouts.app')
@section('content')
 <div class="container">
 	@if(Session::has('notice'))
       <div class="alert alert-success">
          {{ Session::get('notice') }}
       </div>
    @endif
    <td>
      {!! link_to('suscriptors/news', 'Suscribirse!', ['class' => 'btn btn-primary']) !!} <br>
    </td>
    <h1> Buscas alguien en especial? </h1>
    <a>
    	 @foreach ($suscriptores as $suscriptor)
                <a href="#" class="btn btn-info" role="button"> {{ $suscriptor->name }} </a> <br>
          @endforeach
    	algo es algo:
    </a>
 </div>
@endsection