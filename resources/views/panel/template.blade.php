@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración.</p>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4 col-xl-4">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h4>Usuarios</h4>
                        @php
                            $cant_usuarios = \App\Models\User::count();
                        @endphp
                        <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{ $cant_usuarios }}</span></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-4">
                <div class="card bg-c-pink order-card">
                    <div class="card-block">
                        <h4>Roles</h4>
                        @php
                            $cant_roles = \Spatie\Permission\Models\Role::count();
                        @endphp
                        <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{ $cant_roles }}</span></h2>
                    </div>
                </div>
            </div>

            @can('ver-solicitud')
            <div class="col-md-4 col-xl-4">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h4>Solicitudes Gente de Mar</h4>
                        @php
                            $cant_solicitudes = \App\Models\Solicitud::count('id');
                        @endphp
                        <h2 class="text-right"><i class="fas fa-file f-left"></i><span>{{ $cant_solicitudes }}</span></h2>
                    </div>
                </div>
            </div>
            @endcan

            @can('ver-ttm')
            <div class="col-md-4 col-xl-4">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h4>Solicitudes Transporte y Tráfico</h4>
                        @php
                            $cant_ttms = \App\Models\Vasolicitudttm::count('id');
                        @endphp
                        <h2 class="text-right"><i class="fas fa-file f-left"></i><span>{{ $cant_ttms }}</span></h2>
                    </div>
                </div>
            </div>
            @endcan

        </div>
    </div>
@stop

@section('css')
    {{-- Agrega aquí hojas de estilo adicionales --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("rescata!"); </script>
@stop
