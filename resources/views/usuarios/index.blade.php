@extends('panel.template')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@stop

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración de Usuarios.</p>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-success" href="{{ route('usuarios.create') }}"><i class="fas fa-user-plus"></i></a>
            <br><br>
            <table id="usuarios" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    {{-- <th style="display: none;">ID</th> --}}
                    <th>User Login</th>
                    <th>Nombre</th>
                    {{-- <th>Capitanía</th> --}}
                    <th>Rol</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                    {{-- <td style="display: none;">{{ $usuario->id }}</td> --}}
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->name }}</td>
                   {{--  <td>{{ $usuario->capitania }}</td> --}}
                    <td>
                @if(!empty($usuario->getRoleNames()))
                    @foreach($usuario->getRoleNames() as $rolNombre)
                <h5><span class="badge badge-success mt-2">{{ $rolNombre }}</span></h5>
                @endforeach
                @endif
                </td>

                <td>
                    <form action="{{ route('usuarios.destroy',$usuario->id) }}" method="POST" class="formulario-eliminar">
                <a class="btn btn-warning" href="{{ route('usuarios.edit',$usuario->id) }}"><i class="fas fa-user-edit"></i></a>

                    @csrf

                    @method('DELETE')
                    @can('borrar-usuario')
                        <button type="submit" class="btn btn-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
                    @endcan

                </form>

                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
        $(document).ready(function () {
            $('#usuarios').DataTable({
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
            'next':'siguiente',
            'previous': 'anterior'}
            }
            });

        });
    </script>
    <script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>

    <script>

    $('.formulario-eliminar').submit(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Estas seguro de eliminar este usuario?',
        text: "No podrás revertir loa cambios.!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#599365',
        cancelButtonColor:  '#d33',
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
