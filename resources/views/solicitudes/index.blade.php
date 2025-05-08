@extends('panel.template')

@section('title', 'Sinea')

@section('content_header')
    <h1>SINEA</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración de solicitudes SINEA.</p>
    <div class="section-content">
        <div class="card">
            <div class="card-body">
                <form class="row g-3" action={{ route('solicitud.buscar') }} method="POST">
                    @csrf
                    <div class="col-md-3">
                        <label for="#" class="form-label">Numero solicitud</label>
                        <input type="number" required class="form-control" id="nro_solicitud" name="nro_solicitud"
                            placeholder="Ingrese el número de solicitud">
                    </div>
                    <div class="col-md-3 mt-5">
                        <button type="submit" class="btn btn-primary" title="Buscar"><i class="fas fa-search"></i></button>
                    </div>

                </form>
                <br>
            </div>
        </div>
    </div>
@stop
