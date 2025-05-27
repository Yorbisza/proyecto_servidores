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
                                    <th>IP Servidor</th>
                                    <th>Puerto</th>
                                    <th>Usuario</th>
                                    <th>Ambiente</th>
                                    <th>Capitanias</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

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
                            <input type="hidden" id="serve_id" name="serve_id">
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
            var serverId = $(this).data('id'); // Obtener el ID del botón
            var modal = $('#accessKeyModal');

            // Validar el ID antes de abrir el modal
            if (serverId) {
                modal.find('#serve_id').val(serverId); // Establecer el ID en el campo oculto
                console.log('ID del servidor capturado:', serverId); // Para depuración
            } else {
                console.error('No se pudo capturar el ID del servidor.');
            }
        });
        // Capturar el evento de apertura del modal
        $('#accessKeyModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que abrió el modal
            var serverId = button.data('id'); // Extraer el ID del atributo data-id
            var modal = $(this);
            modal.find('#serve_id').val(serverId); // Establecer el ID en el campo oculto
        });


        let currentAction; // Variable para almacenar la acción actual (mostrar o eliminar)

        // Captura el evento de clic en los botones
        $(document).on('click', '.show-button, .delete-button', function(event) {
            var serverId = $(this).data('id'); // Obtener el ID del botón
            var modal = $('#accessKeyModal');

            // Establecer el ID en el campo oculto
            modal.find('#serve_id').val(serverId);
            currentAction = $(this).hasClass('delete-button') ? 'delete' : 'show'; // Determinar la acción
        });

        // Evento de envío del formulario
        document.getElementById('accessKeyForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío normal del formulario

            const accessKey = document.getElementById('access_key').value;
            const serverId = document.getElementById('serve_id').value;
            const deleteForm = document.querySelector(`.delete-form[data-server-id="${serverId}"]`);

            // Verifica la contraseña
            fetch('{{ route('access.key.verify') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        access_key: accessKey,
                        serve_id: serverId
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
                            window.location.href = '{{ route('servidores.show', '') }}/' +
                                serverId; // Redirige a la vista
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

