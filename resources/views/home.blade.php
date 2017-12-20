@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inicio</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Entraste al sitio, aun no sigues personas asi que busca algunos!
                </div>
            </div>
            <td>
                {!! link_to('suscriptors/news', 'Suscribirse!', ['class' => 'btn btn-primary']) !!} <br>
            </td>
        </div>
    </div>
</div>
@endsection
