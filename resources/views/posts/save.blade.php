@extends('layouts.app')
@section('content')
 <div class="container">
    <h1> Guardar Post </h1>
    {!! Form::open(array('url' => 'posts/' . $post->id, 'method' => $method)) !!}
       <div class="form-group">
          {!! Form::label('titulo', 'Título') !!}
          {!! Form::text('titulo', $post->titulo, ['class' => 'form-control']) !!}
       </div>
       <div class="form-group">
          {!! Form::label('descripcion', 'Descripción') !!}
          {!! Form::textarea('descripcion', $post->descripcion, ['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}
       </div>
       <div class="col-75">
        <select id="privado" name="privado">
          <option value=0>si</option>
          <option value=1>no</option>
        </select>
      </div>
       {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!} 
       {!! link_to('posts', 'Cancelar', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
 </div>
@endsection