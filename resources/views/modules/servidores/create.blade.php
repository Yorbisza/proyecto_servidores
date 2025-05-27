@extends('adminlte::page')
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
                    <form action="{{ route('servidores.store') }}" method="POST" name="proser" id="proser" class="row g-3 needs-validation" onsubmit="return validarFormulario(event)" novalidate>
                        @csrf
                        @method('POST')
<input type="hidden" name="form_type" value="servidores">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre_servidores">Nombre Servidor:</label>
                                <input type="text" class="form-control" id="nombre_servidores" name="nombre_servidores" oninput="this.value = this.value.toUpperCase()" required>
                                <div class="invalid-feedback">
                                    Por favor, coloca el nombre del servidor.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ip_servidores">IP Servidor:</label>
                                <input type="text" class="form-control" id="ip_servidores" name="ip_servidores" onkeypress="return NumerosyPuntos(event)" required>
                                <div class="invalid-feedback">
                                    Por favor, coloca la IP del servidor.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="puerto">Puerto:</label>
                                <input type="number" class="form-control" id="puerto" name="puerto" onkeypress="return soloNumeros(event)" required>
                                <div class="invalid-feedback">
                                    Por favor, coloca el puerto del servidor.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre_usuario">Nombre usuario:</label>
                                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                                <div class="invalid-feedback">
                                    Por favor, coloca el nombre del usuario.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contrasenas">Contraseña:</label>
                                <input type="text" class="form-control" id="contrasenas" name="password" required>
                                <div class="invalid-feedback">
                                    Por favor, coloca la contraseña.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ambiente_id">Ambiente:</label>
                                <select name="ambiente_id" id="ambiente_id" class="form-select" required>
                                    <option value="">Seleccionar</option>
                                    @foreach ($ambientes as $a)
                                        <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Debe seleccionar un ambiente.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="capitania_id">Capitanias:</label>
                                <select name="capitania_id" id="capitania_id" class="form-select" required>
                                    <option value="">Seleccionar</option>
                                    @foreach ($capitanias as $cap)
                                        <option value="{{ $cap->id }}">{{ $cap->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Debe seleccionar una capitania.
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                            <a href="{{ route('servidores.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript para manejar la validación del formulario
    (function() {
        'use strict';

        // Obtener todos los formularios que queremos aplicar estilos de validación
        var forms = document.querySelectorAll('.needs-validation');

        // Recorrerlos y prevenir el envío si hay campos inválidos
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault(); // Evita el envío del formulario
                        event.stopPropagation(); // Detiene la propagación del evento
                    }

                    form.classList.add('was-validated'); // Añadir clase para mostrar estilos de Bootstrap
                }, false);
            });
    })();
</script>
@endsection
