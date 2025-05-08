@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@stop

@section('title', 'Solicitud')

@section('content_header')
    <center>
        <h1>N° de Solicitud </h1>
    </center>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @foreach ($solicitud as $solicitud)
                <center><i class="fa-solid fa-file-pen"></i>
                    <p> <b>Usuario SINEA: </b><b class="text-success">{{ $solicitud->nombre_solicitante }}
                            {{ $solicitud->pnj }}-{{ $solicitud->rif }}</b></p>
                </center>
                <div class="container">
                    <form action="{{ route('solicitud.update', $solicitud->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" class="form-control" id="id" disabled name="id"
                            value="{{ $solicitud->id }}">

                        <div class="row">
                            <div class="col-md-2">
                                <label for="nro_solicitud" class="form-label">Número de Solicitud:</label>
                                <input type="text" class="form-control" disabled id="nro_solicitud" name="nro_solicitud"
                                    value="{{ $solicitud->nro_solicitud }}">
                            </div>

                            <div class="col-md-5">
                                <label for="documento_id" class="form-label">Documento</label>
                                <select class="form-select" aria-label="Default select example" disabled id="documento_id"
                                    name="documento_id">
                                    <option disabled value="{{ $solicitud->documento_id }}"
                                        {{ $solicitud->documento_id == $solicitud->doc_id ? 'selected' : '' }}>
                                        {{ $solicitud->doc_nombre }}
                                    </option>

                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="capitania_id" class="form-label">Capitanías</label>
                                <select class="form-select" aria-label="Default select example" disabled name="capitania_id"
                                    id="capitania_id">
                                    <option value="{{ $solicitud->capitania_id }}"
                                        {{ $solicitud->capitania_id == $solicitud->capid ? 'selected' : '' }}>
                                        {{ $solicitud->cap_nombre }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="status" class="form-label">Estatus de solicitud</label>
                                <select class="form-select" aria-label="Default select example" name="status"
                                    id="status">
                                    <option value="0" <?php if ($solicitud->status == 0) {
                                        echo 'selected';
                                    } ?>>Anulada</option>
                                    <option value="1" <?php if ($solicitud->status == 1) {
                                        echo 'selected';
                                    } ?>>Activa</option>
                                    <option value="2" <?php if ($solicitud->status == 2) {
                                        echo 'selected';
                                    } ?>>Recibida</option>
                                    <option value="3" <?php if ($solicitud->status == 3) {
                                        echo 'selected';
                                    } ?>>Conforme</option>
                                    <option value="4" <?php if ($solicitud->status == 4) {
                                        echo 'selected';
                                    } ?>>No Conforme</option>
                                    <option value="5" <?php if ($solicitud->status == 5) {
                                        echo 'selected';
                                    } ?>>Aprobada</option>
                                    <option value="6" <?php if ($solicitud->status == 6) {
                                        echo 'selected';
                                    } ?>>Autorizada</option>
                                    <option value="7" <?php if ($solicitud->status == 7) {
                                        echo 'selected';
                                    } ?>>Emitida</option>
                                    <option value="12" <?php if ($solicitud->status == 12) {
                                        echo 'selected';
                                    } ?>>Firmado por el Presidente</option>
                                    <option value="13" <?php if ($solicitud->status == 13) {
                                        echo 'selected';
                                    } ?>>Pendiente Firma del Presidente</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="tipo_emision" class="form-label">Tipo de emisión documento</label>
                                <select class="form-select" aria-label="Default select example" name="tipo_emision">
                                    <option value="1" <?php if ($solicitud->tipo_emision == 1) {
                                        echo 'selected';
                                    } ?>>Original</option>
                                    <option value="2" <?php if ($solicitud->tipo_emision == 2) {
                                        echo 'selected';
                                    } ?>>Copia</option>
                                    <option value="3" <?php if ($solicitud->tipo_emision == 3) {
                                        echo 'selected';
                                    } ?>>Renovación</option>
                                </select>
                            </div>
                            <div class="col-md-2 bm-3">
                                <label for="firmada" class="form-label">PDF Firmado</label>

                                <select class="form-select" aria-label="Default select example" name="firmada">
                                    <option value="false" <?php if ($solicitud->firmada == 0) {
                                        echo 'selected';
                                    } ?>>No</option>
                                    <option value="true" <?php if ($solicitud->firmada == 1) {
                                        echo 'selected';
                                    } ?>>Si</option>
                                </select>
                            </div>
                            <div class="col-md-2 bm-3">
                                <label for="pdf_signed_sent" class="form-label">PDF Enviado</label>
                                <select class="form-select" aria-label="Default select example" name="pdf_signed_sent">
                                    <option value="false" <?php if ($solicitud->pdf_signed_sent == 0) {
                                        echo 'selected';
                                    } ?>>No</option>
                                    <option value="true" <?php if ($solicitud->pdf_signed_sent == 1) {
                                        echo 'selected';
                                    } ?>>Si</option>
                                </select>
                            </div>
                            {{--      <div class="col-md-2 bm-3">
                                <label for="nro_solicitud">Ruta PDF:</label>
                                <input type="text" class="form-control" id="pdf_signed" name="pdf_signed"
                                    value="{{ $solicitud->pdf_signed }}">
                            </div> --}}
                            @if ($solicitud->pdf_signed )
                                <div class="col-md-2 mb-3"> <label for="pdf_signed">Ruta PDF:</label> <input type="text"
                                        class="form-control" id="pdf_signed" name="pdf_signed"
                                        value="{{ $solicitud->pdf_signed }}">
                                </div>
                            @endif
                            @if ($solicitud->pdf_signed_user_id)
                                <div class="col-md-2 bm-3">
                                    <label for="nro_solicitud">Usuario PDF:</label>
                                    <input type="text" class="form-control" id="pdf_signed_user_id"
                                        name="pdf_signed_user_id" value="{{ $solicitud->pdf_signed_user_id }}">
                                </div>
                            @endif
                            @if ($solicitud->pdf_signed_timestamp)
                                <div class="col-md-2 mb-3">
                                    <label for="pdf_signed_timestamp" class="form-label">Fecha de Firma</label>
                                    <input type="text" class="form-control" id="pdf_signed_timestamp"
                                        name="pdf_signed_timestamp" value="{{ $solicitud->pdf_signed_timestamp }}">
                                </div>
                            @endif

                            {{-- <div class="col-md-2 bm-3">
                                <label for="created" class="form-label">Fecha de creación</label>
                                <input type="datetime" class="form-control" id="created" disabled name="created"
                                    value="{{ $solicitud->created }}">
                            </div> --}}
                            <div class="col-md-3 mb-3">
                                <label for="fecha_solicitud" class="form-label"> Fecha de solicitud</label>
                                <input type="datetime" class="form-control" id="fecha_solicitud" disabled
                                    name="fecha_solicitud" value="{{ $solicitud->fecha_solicitud }}">
                            </div>
                            {{-- <div class="col-md-2 mb-3">
                                <label for="modified" class="form-label">Fecha de modificación</label>
                                <input type="datetime" class="form-control" id="modified" disabled name="modified"
                                    value="{{ $solicitud->modified }}">
                            </div> --}}
                            @can('editar-solicitud')
                                <div class="col-md-3 mt-4">
                                    <button type="submit" class="btn btn-warning" title="Editar Solicitud">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            @endcan
                            <br><br>

                            @if ($solicitud->solicitud_id)
                                <br>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <input type="hidden" class="form-control" id="id" disabled name="id"
                                value="{{$solicitud->solicitud_id}}"/>
                                <div class="accordion-item">
                                    <h2 class="accordion-headera">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            <p class="alert alert-danger">Numero de Control
                                                <i class="fas fa-file-alt"></i>
                                            </p>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <div class="col-md-2 mb-3">
                                                <label for="nro_ctrl" class="form-label">Número de Control</label>
                                                <input type="number" class="form-control" id="nro_ctrl"
                                                    name="nro_ctrl" value="{{ $solicitud->nro_ctrl }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="fecha_registro" class="form-label">Fecha de Registro</label>
                                                <input type="datetime" class="form-control" id="fecha_registro" disabled
                                                    name="fecha_registro" value="{{ $solicitud->fecha_registro }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="fecha_emision" class="form-label">Fecha de emisión</label>
                                                <input type="datetime" class="form-control" id="fecha_emision" disabled
                                                    name="fecha_emision" value="{{ $solicitud->fecha_emision }}">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="fecha_vencimiento" class="form-label">Fecha de
                                                    vencimiento</label>
                                                <input type="datetime" class="form-control" id="fecha_vencimiento"
                                                    disabled name="fecha_vencimiento"
                                                    value="{{ $solicitud->fecha_vencimiento }}">
                                            </div>
                                            @can('borrar-solicitud')
                                                <div class="col-md-1 mt-4">
                                                    <button type="button" class="btn btn-danger deleteSolicitud"
                                                        data-id="{{ $solicitud->id }}" title="Eliminar Ctrl_documentos">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endcan
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
        </div>
    </div>
    @endforeach
    </div>
    </div>
    </div>

@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.deleteSolicitud').forEach(function(button) {
            button.addEventListener('click', function() {
                var solicitudId = this.dataset.id;
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'No podrás revertir esta acción',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#09B064',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('{{ route('solicitud.destroy', ':id') }}'.replace(':id',
                                solicitudId), {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(function(response) {
                                if (result.isConfirmed) {
                                    console.log('Solicitud eliminada correctamente');
                                    Swal.fire(
                                            '¡Eliminado!',
                                            'La solicitud ha sido eliminada.',
                                            'success'
                                        )
                                        .then(() => {
                                            window.location.reload();
                                        });
                                } else {
                                    console.error('Error al eliminar la solicitud');
                                    Swal.fire(
                                        '¡Error!',
                                        'No se pudo eliminar la solicitud.',
                                        'error'
                                    );

                                }
                            })
                            .catch(function(error) {
                                console.error('Error de red:', error);
                                Swal.fire(
                                    '¡Error!',
                                    'Hubo un error de red, inténtalo de nuevo.',
                                    'error'
                                );
                            });
                    }
                });
            });
        });
    </script>
@stop
