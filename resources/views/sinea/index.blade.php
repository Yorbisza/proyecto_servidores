@extends('panel.template')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@stop

@section('title', 'Roles y Permisos')

@section('content_header')
    <h1>SINEA</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración de solicitudes sinea.</p>

    <div class="card">
        <div class="card-body">
            <form class="row g-3" action="?c=solicitud&m=consultar" method="POST">
                <div class="col-md-3">
                    <label for="#" class="form-label">nro solicitud</label>
                    <input type="number" required class="form-control" id="nro_solicitud" name="nro_solicitud"
                        placeholder="Ingrese el número de solicitud">
                </div>
                <div class="col-md-2 mt-4">
                <a href="#"><button type="submit" class="btn btn-primary" title="Buscar">BUSCAR</button></a>
                </div>
            </form>
        </div>
    </div>
@stop
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'Su datos han sido eliminado.',
                'success'
            )
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#roles').DataTable({
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
    <script>
        < script src = "https://cdn.jsdelivr.net/npm/sweetalert2@11" >
    </script>

    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Estas seguro de eliminar este Rol?',
                text: "No podrás revertir loa cambios.!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#599365',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            })
        });
    </script>
@stop
