@extends('panel.template')

@section('title', 'Servidores')

@section('content_header')
    <h1>CREAR SERVIDOR</h1>
@stop

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table bordered text-center">
                            <thead>
                                <tr>
                                    <th>Nombre Servidor</th>
                                    <th>IP Servidor</th>
                                    <th>Puerto</th>
                                    <th>Nombre Usuario</th>
                                    <th>Password</th>
                                    <th>Ambiente</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>{{ $serve->nombre_servidores }}</b></td>
                                    <td><b>{{ $serve->ip_servidores }}</b></td>
                                    <td><b>{{ $serve->puerto }}</b></td>
                                    <td><b>{{ $contrasena->nombre_usuario ?? 'N/A' }}</b></td>
                                    <td><b>{{ $contrasena->password ?? 'N/A' }}</b></td>
                                    <td><b>{{ $ambientes->nombre ?? 'N/A' }}</b></td>
                                    <td><b>{{ $status->nombre ?? 'N/A' }}</b></td>
                                    <td>
                                        <form method="post" action="{{ route('servidores.destroy', $serve->id) }}">
                                            <a href="{{ route('servidores.index') }}"
                                                class="btn btn-secondary mt-3">Cancelar</a>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
