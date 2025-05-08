@extends('panel.template')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@stop

@section('title', 'Auditoria')

@section('content_header')
    <h1>Auditoria</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración de Auditoria.</p>

    <div class="card">
        <div class="card-body">
            <div class="card-body">
                <table id="dt_aufits" class="table table-striped dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Modelo</th>
                            <th>Evento</th>
                            <th>Campos Modificados</th>
                            <th>SOLICITUD_ID</th>
                            <th>Valores Anteriores</th>
                            <th>Nuevos Valores</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Ip</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($audits as $audit)
                            <tr>
                                <td>{{ $audit->id }}</td>
                                <td>{{ $audit->auditable_type }}</td>
                                <td>{{ $audit->event }}</td>
                                <td>
                                    @foreach ($audit->getModified() as $key => $value)
                                        <p>{{ $key }}</p>
                                    @endforeach
                                </td>
                                <td>{{ $audit->auditable_id }}</td>
                                <td>
                                    @foreach ($audit->getModified() as $key => $value)
                                        <p>{{ $value['old'] ?? 'N/A' }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($audit->getModified() as $key => $value)
                                        <p>{{ $value['new'] ?? 'N/A' }}</p>
                                    @endforeach
                                </td>
                                <td>{{ $audit->user ? $audit->user->name : 'N/A' }}</td>
                                <td>{{ $audit->created_at }}</td>
                                <td>{{ $audit->ip_address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dt_aufits').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar  _MENU_ Registros por Pagina",
                    "zeroRecords": "No se encontro ningún registro",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(Filtrado de _MAX_ registro totales)",
                    'search': 'Buscar:',
                    'paginate': {
                        'next': 'siguiente',
                        'previous': 'anterior'
                    }
                }
            });
        });
    </script>
@stop
