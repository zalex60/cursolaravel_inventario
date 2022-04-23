@extends('layouts.app')

@section('content')
<div class="container">
    <h4 align="center" class="font-bold">Estas a solo un paso poder usar el sistema, solo debes definir una contraseña</h4>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Recuperar contraseña</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('verificar.email') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="messages">
                                @if(Session::has('message_warning'))
                                <div class="alert alert-dismissable alert-warning">{{ Session::get('message_warning') }}</div>
                                @endif
                                @if(Session::has('message_danger'))
                                <div class="alert alert-dismissable alert-danger">{{ Session::get('message_danger') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="contrasena" required placeholder="Contraseña">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="confirmar" required placeholder="Confirmar contraseña">
                        </div>
                        <input type="text" name="token" hidden="true" value="{{$token}}">                    
                        <button type="submit" class="btn btn-primary block full-width m-b">Guardar contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection