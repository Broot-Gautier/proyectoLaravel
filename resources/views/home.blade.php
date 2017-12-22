@extends('layouts.app')

@section('content')
<div class="container">
    <h2><span class="label label-primary">Bienvenido <?= $username; ?></span></h2>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Posts disponibles</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($suscritos as $suscrito)
                    <div class="row">
                    <a href='{{ 'posts/'.$suscrito[0]['id'] }}'> {{ $suscrito['name_id'] }}</a>
                    </div>
                @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
