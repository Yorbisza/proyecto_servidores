@extends('panel.template')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@stop

@section('title', 'Agregar | Roles y Permisos')

@section('content_header')
    <h1>Roles y Permisos</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración de Roles y Peermisos.</p>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <strong>¡Revise los campos!</strong>
                @foreach ($errors->all() as $error)
                    <span class="badge badge-danger">{{ $error }}</span>
                @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif


        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="">Rol:</label>
                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="">Permisos para este Rol:</label>
                    <br/>
                    @foreach($permission as $value)
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="permission[]" value="{{ $value->id }}" {{ $value->checked ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexSwitchCheckDefault">{{ $value->name }}</label>
                      </div>
                    <br/>
                    @endforeach
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')

@stop
