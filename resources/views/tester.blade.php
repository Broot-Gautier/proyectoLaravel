@extends('layouts.app')

@section('content')
	<tr>
		Hey estas viendo del usuario <?= $usuario; ?>
	</tr>
	<tr>
		Y quieres seguir al usuario con id <?= $aseguir; ?>
	</tr>
	<h2> a los que sigues </h2>
    
@endsection