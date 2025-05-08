@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@stop

@section('content_header')
    <h1>Seguridad Marítima</h1>
@stop

@section('content')
<p>Bienvenido al panel de administración de Seguridad Marítima.</p>

    <div class="card">
    <div class="card-body">
        @include('flash::message')
        <table id="segumar" class="table table-striped dt-responsive nowrap" style="width:100%">
        <thead>
            <th>Nombre Buque</th>
            <th>Matricula</th>
            <th>Eslora</th>
            <th>UAB</th>
            <th>Destinación</th>
            <th>Acciones</th>
        </thead>
        </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
    $('#segumar').DataTable({

            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{route('sgm.index')}}",
            dataType: 'json',
            type: "POST",
        "columns": [

            {data: 'nombre_actual'},
            {data: 'matricula_actual'},
            {data: 'eslora'},
            {data: 'uab'},
            {data: 'destinacion',
                searchable: false,
                orderable: false
            },

            {
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    orderable: false
                }
        ],
        language: {
            lengthMenu: 'Mostar _MENU_ Registro por Pagina',
            zeroRecords: 'No se encontró ningún registro',
            info: 'Mostrando Pagina _PAGE_ de _PAGES_',
            search: 'Buscar',
            infoEmpty: 'No hay registros disponibles',
            infoFiltered: '(Filtrado de _MAX_ registro totales)',
            paginate: {
                next: 'Siguiente',
                previous: 'Anterior'

            }
        },
    });
});
    </script>
@stop
