@extends('layouts.app')
@section('content')
 <div class="container">
    <h1> {{ $post->titulo }} </h1>
    <div class="row">
       <div class="col-lg-12">
          {{ $post->descripcion }}
       </div>
       <hr />
       <div class="col-lg-12">
          {!! link_to('posts', 'Volver', ['class' => 'btn btn-danger']) !!}
       </div>
    </div>
 </div>
@endsection