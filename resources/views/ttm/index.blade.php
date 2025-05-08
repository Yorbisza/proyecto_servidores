@extends('panel.template')

@section('title', 'Transporte y Tráfico')

@section('content_header')
    <h1>SINEA</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración de solicitudes Transporte y Tráfico.</p>
    <div class="section-content">
        <div class="card">
            <div class="card-body">
                <form class="row g-3" action={{ route('ttm') }} method="POST">
                    @csrf
                    <div class="col-md-3">
                        <label for="#" class="form-label">Número de Solicitud</label>
                        <input type="number" required class="form-control" id="vasolicitud" name="vasolicitud"
                            placeholder="Número de solicitud">
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
