@extends('panel.template')

@section('title', 'Servidores')

@section('content_header')
    <h1>CREAR SERVIDOR</h1>
@stop

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card ">
                    <div class="card-body">
                        <form action="{{ route('servidores.update', $serve->id) }}" method="POST" name="proser"
                            id="proser" class="row g-3 needs-validation" onsubmit="return validarFormulario(event)" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="col-xs-3 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label for="nombre_servidores">Nombre Servidor:</label>
                                    <input type="text" class="form-control" id="nombre_servidores"
                                        name="nombre_servidores" value="{{ $serve->nombre_servidores }}" required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca el nombre del servidor.
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ip_servidores">IP Servidor:</label>
                                    <input type="text" class="form-control" id="ip_servidores" name="ip_servidores"
                                        value="{{ $serve->ip_servidores }}" required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca la IP del servidor.
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="puerto">Puerto:</label>
                                    <input type="number" class="form-control" id="puerto" name="puerto"
                                        value="{{ $serve->puerto }}" required>
                                        <div class="invalid-feedback">
                                            Por favor, coloca el puerto del servidor.
                                        </div>
                                </div>
                            </div>

                            @if ($contrasenas->isNotEmpty())
                                @php
                                    $firstPassword = $contrasenas->first();
                                @endphp
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_usuario">Nombre Usuario:</label>
                                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario"
                                            value="{{ $firstPassword->nombre_usuario }}" required>
                                            <div class="invalid-feedback">
                                                Por favor, coloca el nombre del usuario.
                                            </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Contraseña: </label>
                                        <input type="text" class="form-control" id="password" name="password"
                                            value="{{ $firstPassword->password }}" required>
                                            <div class="invalid-feedback">
                                                Por favor, coloca la contraseña.
                                            </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_usuario">Nombre Usuario:</label>
                                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario"
                                            value="" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Contraseña: </label>
                                        <input type="text" class="form-control" id="password" name="password"
                                            value="" required>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-4">
                                <label for="ambiente_id">Ambiente: </label>
                                <select name="ambiente_id" id="ambiente_id" class="form-select" required>
                                    <option value="{{ $serve->ambiente_id }}">
                                        {{ $ambientes->firstWhere('id', $serve->ambiente_id)->nombre ?? 'Selecciona un ambiente' }}
                                    </option>
                                    @foreach ($ambientes as $a)
                                        @if ($a->id !== $serve->ambiente_id)
                                            <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Debe seleccionar un ambiente.
                                </div>
                            </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="capitania_id">Capitanias: </label>
                            <select name="capitania_id" id="capitania_id" class="form-select" required>
                                <option value="{{ $serve->capitania_id }}">
                                    {{ $capitanias->firstWhere('id', $serve->capitania_id)->nombre ?? 'Selecciona una capitania' }}
                                </option>
                                @foreach ($capitanias as $cap)
                                    @if ($cap->id !== $serve->çapitania_id)
                                        <option value="{{ $cap->id }}">{{ $cap->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Debe seleccionar una capitania.
                            </div>
                        </div>
                        <div class="col-12">
                    <button class="btn btn-warning mt-3">Actualizar</button>
                    <a href="{{ route('servidores.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

@endsection
