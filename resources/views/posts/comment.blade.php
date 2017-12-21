@extends('layouts.app')
 @section('content')
{!! Form::open(array('url' => 'comentarlo/'.$comentario->post_id ,'method' => $method)) !!}
<h2><?= $comentario->post_id; ?></h2>
 <div class=”form-group”>
  <div class=”form-group”>
     @if(!empty($errors->first('comment')))
        <div class=”alert alert-danger”>{{ $errors->first('comment') }}</div>
    @endif
    {!! Form::label('comentario', 'Comment') !!}
    {!! Form::textarea('comentario', $comentario->comentario, array('class' => 'form-control', 'rows' => '4')) !!}
  </div>
    {!! Form::submit('Comentar Ahora!', array('class' => 'btn btn-default')) !!}
    {!! Form::close() !!}
 </div>
 @endsection