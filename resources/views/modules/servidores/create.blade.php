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
                        <div class="form-group">
                            <label for="categoria_select">Categoría:</label>
                            <select name="categoria_id" id="categoria_select" class="form-select"
                                onchange="mostrarFormulario()" required>
                                <option value="">Seleccionar</option>
                                @foreach ($categorias as $c)
                                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Debe seleccionar una categoría.
                            </div>
                        </div>
                        <!--Formulario para crear servidores -->
                        <form action="{{ route('servidores.store') }}" method="POST" name="proser" id="proser"
                            class="row g-3 needs-validation" onsubmit="return validarFormulario(event)"
                            style="display: none;" novalidate>
                            @csrf
                            @method('POST')

                            <input type="hidden" id="categoria_id" name="categoria_id" value="1">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_servidores">Nombre Servidor:</label>
                                        <input type="text" class="form-control" id="nombre_servidores"
                                            name="nombre_servidores" oninput="this.value = this.value.toUpperCase()"
                                            required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca el nombre del servidor.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ip_servidores">IP Servidor:</label>
                                        <input type="text" class="form-control" id="ip_servidores" name="ip_servidores"
                                            onkeypress="return NumerosyPuntos(event)" required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca la IP del servidor.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="puerto">Puerto:</label>
                                        <input type="number" class="form-control" id="puerto" name="puerto"
                                            onkeypress="return soloNumeros(event)" required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca el puerto del servidor.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_usuario">Nombre usuario:</label>
                                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario"
                                            required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca el nombre del usuario.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contrasenas">Contraseña:</label>
                                        <input type="text" class="form-control" id="contrasenas" name="password"
                                            required>
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
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="capitania_id">Capitanías:</label>
                                        <select name="capitania_id" id="capitania_id" class="form-select" required>
                                            <option value="">Seleccionar</option>
                                            @foreach ($capitanias as $cap)
                                                <option value="{{ $cap->id }}">{{ $cap->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Debe seleccionar una capitanía.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                                    <a href="{{ route('servidores.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
                                </div>
                            </div>
                        </form>
                        <!--Formulario para crear Base de Datos -->

                        <form action="{{ route('baseDatos.store') }}" method="POST" name="proser" id="db"
                            class="row g-3 needs-validation" onsubmit="return validarFormulario(event)"
                            style="display: none;" novalidate>
                            @csrf
                            @method('POST')

                            <input type="hidden" id="categoria_id" name="categoria_id" value="2">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_servidor">Nombre Servidor:</label>
                                        <input type="text" class="form-control" id="nombre_servidor"
                                            name="nombre_servidor" oninput="this.value = this.value.toUpperCase()"
                                            required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca el nombre del servidor.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_database">Nombre Base de Datos:</label>
                                        <input type="text" class="form-control" id="nombre_database"
                                            name="nombre_database" oninput="this.value = this.value.toUpperCase()"
                                            required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca el nombre de Base de Datos.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ip_database">IP Base de Datos:</label>
                                        <input type="text" class="form-control" id="ip_database" name="ip_database"
                                            required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca la IP de Base de Datos.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="puerto">Puerto:</label>
                                        <input type="number" class="form-control" id="puerto" name="puerto"
                                            onkeypress="return soloNumeros(event)" required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca el puerto del servidor.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_usuario">Nombre usuario:</label>
                                        <input type="text" class="form-control" id="nombre_usuario"
                                            name="nombre_usuario">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Contraseña:</label>
                                        <input type="text" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
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

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                                    <a href="{{ route('baseDatos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarFormulario() {
            var select = document.getElementById("categoria_select");
            var proser = document.getElementById("proser");
            var db = document.getElementById("db");

            // Mostrar el formulario solo si la categoría seleccionada es "1"
            if (select.value === "1") {
                proser.style.display = "block"; // Muestra el formulario
            } else {
                proser.style.display = "none"; // Oculta el formulario si no es "1"
            }
            if (select.value === "2") {
                db.style.display = "block"; // Muestra el formulario
            } else {
                db.style.display = "none"; // Oculta el formulario si no es "1"
            }
        }


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

                        form.classList.add(
                            'was-validated'); // Añadir clase para mostrar estilos de Bootstrap
                    }, false);
                });
        })();
    </script>
@endsection
