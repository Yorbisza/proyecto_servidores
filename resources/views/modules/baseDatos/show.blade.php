@extends('panel.template')

@section('title', 'Servidores')

@section('content_header')
    <h1>VISTA DB</h1>
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
                                    <th>Nombre DB</th>
                                    <th>IP DB</th>
                                    <th>Puerto</th>
                                    <th>Nombre Usuario</th>
                                    <th>Password</th>
                                    <th>Ambiente</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>{{ $dbData->nombre_servidor }}</b></td>
                                    <td><b>{{ $dbData->nombre_database }}</b></td>
                                    <td><b>{{ $dbData->ip_database }}</b></td>
                                    <td><b>{{ $dbData->puerto }}</b></td>
                                    <td><b>{{ $contrasena->nombre_usuario ?? 'N/A' }}</b></td>
                                    <td><b>{{ $contrasena->password ?? 'N/A' }}</b></td>
                                    <td><b>{{ $ambientes->nombre ?? 'N/A' }}</b></td>
                                    <td>
                                        <form method="post" action="{{ route('servidores.destroy', $dbData->id) }}">
                                            <a href="{{ route('baseDatos.index') }}"
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
