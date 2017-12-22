@extends('layouts.app')
@section('content')
 <div class="container">
    <h1> {{ $post->{'titulo'} }} </h1>
    <div class="row">
       <div class="col-lg-12">
          {{ $post->descripcion }}
       </div>
       <br>
       <div class="media">
        <div class="media-body">
            <iframe width="980" height="560" 
            src="http://www.youtube.com/embed/{{$post->url}}" frameborder="1" allowfullscreen>
            </iframe>
        </div>
      </br>
       <hr />
       <div class="col-lg-12">
          {!! link_to('posts', 'Volver', ['class' => 'btn btn-danger']) !!}
       </div>
    </div>
 </div>
@endsection