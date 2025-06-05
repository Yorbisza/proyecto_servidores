@extends('panel.template')

@section('title', 'Sinea')

@section('content_header')
    <h1>BASE DE DATOS</h1>
@stop
@section('content')
    <p>Bienvenido al panel de administración de Base de Datos INEA.</p>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('baseDatos.create') }}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                        <table class="table table-sm text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Servidor</th>
                                    <th>Nombre Base de Datos</th>
                                    <th>IP DB</th>
                                    <th>Puerto</th>
                                    <th>Usuario</th>
                                    <th>Ambiente</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($database as $db)
                                    <tr>
                                        <td><b>{{ $db->id }}</b></td>
                                        <td><b>{{ $db->nombre_servidor }}</b></td>
                                        <td><b>{{ $db->nombre_database }}</b></td>
                                        <td><b>{{ $db->ip_database }}</b></td>
                                        <td><b>{{ $db->puerto }}</b></td>
                                        <td><b>{{ $contrasenas->where('db_id', $db->id)->first()->nombre_usuario ?? 'N/A' }}</b>
                                        </td>
                                        <td><b>{{ $ambientes->where('id', $db->ambiente_id)->first()->nombre ?? 'N/A' }}</b>
                                        </td>
                                        <td>
                                            <form method="post" action="{{ route('baseDatos.destroy', $db->id) }}"
                                                class="delete-form" data-db-id="{{ $db->id }}">
                                                <button type="button" class="btn btn-info show-button" data-toggle="modal"
                                                    data-target="#accessKeyModal" data-id="{{ $db->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ route('baseDatos.edit', $db->id) }}"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" type="button"
                                                    >
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="accessKeyModal" tabindex="-1" role="dialog" aria-labelledby="accessKeyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accessKeyModalLabel">Ingrese su contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="accessKeyForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="access_key">Contraseña</label>
                            <input type="password" name="access_key" id="access_key" class="form-control" required>
                            <input type="hidden" id="db_id" name="db_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '[data-toggle="modal"][data-target="#accessKeyModal"]', function(event) {
            var dbId = $(this).data('id'); // Obtener el ID del botón
            var modal = $('#accessKeyModal');

            // Validar el ID antes de abrir el modal
            if (dbId) {
                modal.find('#db_id').val(dbId); // Establecer el ID en el campo oculto
                console.log('ID del servidor capturado:', dbId); // Para depuración
            } else {
                console.error('No se pudo capturar el ID del servidor.');
            }
        });
        // Capturar el evento de apertura del modal
        $('#accessKeyModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que abrió el modal
            var dbId = button.data('id'); // Extraer el ID del atributo data-id
            var modal = $(this);
            modal.find('#db_id').val(dbId); // Establecer el ID en el campo oculto
        });


        let currentAction; // Variable para almacenar la acción actual (mostrar o eliminar)

        // Captura el evento de clic en los botones
        $(document).on('click', '.show-button, .delete-button', function(event) {
            var dbId = $(this).data('id'); // Obtener el ID del botón
            var modal = $('#accessKeyModal');

            // Establecer el ID en el campo oculto
            modal.find('#db_id').val(dbId);
            currentAction = $(this).hasClass('delete-button') ? 'delete' : 'show'; // Determinar la acción
        });

        // Evento de envío del formulario
        document.getElementById('accessKeyForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío normal del formulario

            const accessKey = document.getElementById('access_key').value;
            const dbId = document.getElementById('db_id').value;
            const deleteForm = document.querySelector(`.delete-form[data-db-id="${dbId}"]`);

            // Verifica la contraseña
            fetch('{{ route('access.key.verify') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        access_key: accessKey,
                        db_id: dbId
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        sessionStorage.setItem('access_key_verified', true);
                        $('#accessKeyModal').modal('hide');

                        if (currentAction === 'delete') {
                            deleteForm.submit(); // Envía el formulario de eliminación
                        } else if (currentAction === 'show') {
                            window.location.href = '{{ route('baseDatos.show', '') }}/' +
                                dbId; // Redirige a la vista
                        }
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
