@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@stop

@section('title', 'SINEA | TTM')

@section('content_header')
    <center>
        <h1>Detalles de la Solicitud</h1>
    </center>
@stop


@section('content')
    <div class="card">
        <div class="card-body">
            @foreach ($solicitud as $solicitud)
                <center><i class="fa-solid fa-file-pen"></i>
                    <p> <b>Usuario SINEA: </b><b class="text-success">{{ $solicitud->nombre }}
                            {{ $solicitud->pnj }}-{{ $solicitud->rif }}</b></p>
                </center>
                <div class="row">
                    <form action="{{ route('vasolicitud.update', $solicitud->vasolicitude_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="container">

                            <center><i class="fa-solid fa-file-pen"></i>
                                <p> <b>Documento:  </b><b class="text-success text-black">{{$solicitud->nomactv}}</b></p>
                            </center>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="vasolicitud_id" class="form-label">Número de solicitud</label>
                                    <input type="text" class="form-control" disabled id="vasolicitud_id"
                                        name="vasolicitud_id" value="{{ $solicitud->vasolicitude_id }}">
                                </div>

                                  {{--   <div class="col-md">
                                        <label for="folioinea" class="form-label">Documento</label>
                                        <input type="text" class="form-control" disabled id="vaactividade_id" name="vaactividade_id"
                                            value="{{ $solicitud->nomactv }}" style="flex: auto; width: auto; min-width: 100%;">
                                    </div> --}}

                                <div class="col-md-2">
                                    <label for="status" class="form-label">Estatus:</label>
                                    <select class="form-select" aria-label="Default select example" name="status"
                                        id="status">
                                        <option value="0" <?php if ($solicitud->status == 0) {
                                            echo 'selected';
                                        } ?>>Anulada</option>

                                        <option value="1" <?php if ($solicitud->status == 1) {
                                            echo 'selected';
                                        } ?>>A la espea de Verificación</option>

                                        <option value="2" <?php if ($solicitud->status == 2) {
                                            echo 'selected';
                                        } ?>>Asignada al Analista</option>

                                        <option value="3" <?php if ($solicitud->status == 3) {
                                            echo 'selected';
                                        } ?>>Verificada</option>

                                        <option value="4" <?php if ($solicitud->status == 4) {
                                            echo 'selected';
                                        } ?>>Por Evaluar</option>

                                        <option value="6" <?php if ($solicitud->status == 6) {
                                            echo 'selected';
                                        } ?>>Editada</option>

                                        <option value="8" <?php if ($solicitud->status == 8) {
                                            echo 'selected';
                                        } ?>>Por Editar</option>

                                        <option value="9" <?php if ($solicitud->status == 9) {
                                            echo 'selected';
                                        } ?>>Incompleta</option>

                                        <option value="12" <?php if ($solicitud->status == 12) {
                                            echo 'selected';
                                        } ?>>Por Elaboración de Autorización</option>

                                        <option value="13" <?php if ($solicitud->status == 13) {
                                            echo 'selected';
                                        } ?>>En Proceso</option>

                                        <option value="14" <?php if ($solicitud->status == 14) {
                                            echo 'selected';
                                        } ?>>Firmado por Presidencia</option>

                                        <option value="15" <?php if ($solicitud->status == 15) {
                                            echo 'selected';
                                        } ?>>Por Evaluar</option>

                                        <option value="99" <?php if ($solicitud->status == 99) {
                                            echo 'selected';
                                        } ?>>Entregado </option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="folioinea" class="form-label">Folio</label>
                                    <input type="text" class="form-control" disabled id="folioinea" name="folioinea"
                                        value="{{ $solicitud->folioinea }}">
                                </div>

                                <div class="col-md-2">
                                    <label for="observacion" class="form-label">Observación</label>
                                    <input type="text" class="form-control" id="observacion" name="observacion"
                                    placeholder="Observación" value="{{ $solicitud->observacion }}">
                                </div>
                                @if ($fechavencimiento->isEmpty())
                                @else
                                    @foreach ($fechavencimiento as $item)
                                        <div class="col-md-2">
                                            <label for="fecexpedicion" class="form-label">Fecha De Modificación</label>
                                            <input type="datetime" class="form-control" disabled id="fecexpedicion"
                                                name="fecexpedicion" value="{{ $item->fecexpedicion }}">
                                        </div>

                                        <!-- Cambié la variable a $item para evitar confusiones -->
                                        @if ($item->fecvencimiento)
                                            <!-- Verifica si existe la fecha de vencimiento -->
                                            <div class="col-md-2">
                                                <label for="fecvencimiento" class="form-label">Fecha de Vencimiento</label>
                                                <input type="datetime" class="form-control" id="fecvencimiento"
                                                    name="fecvencimiento" value="{{ $item->fecvencimiento }}">
                                                <!-- Asegúrate de usar `value` aquí -->
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <div class="col-md-3 mt-4">
                                    @can('editar-ttm')
                                    <button type="submit" class="btn btn-warning" title="Editar Solicitud">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @endcan
                                </div>

                    </form>

                </div>
                <hr>
            @endforeach
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <p class="alert alert-danger"> Requisitos de la solicitud
                                    <i class="fas fa-file-alt"></i>
                                </p>
                            </button>
                        </h2>

                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <ul>
                                    @if ($recaudos->isEmpty())
                                        <p>No se encontraron recaudos de esta solicitud.</p>
                                    @else
                                        @foreach ($recaudos as $recaudos)
                                            @if ($recaudos->nomreq)
                                                <div
                                                    class="col-md-10 mt-2 d-flex justify-content-between align-items-center">
                                                    <li> {{ $recaudos->nomreq }} </li>
                                                    @can('borrar-ttm')
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm me-2  deleteRecaudo"
                                                        data-vasolicitude-id="{{ $recaudos->id }}"><i class="fas fa-trash"></i>
                                                    </button>
                                                    @endcan
                                                </div>
                                            @endif
                                        @endforeach
                                        <br>
                                        <center>
                                            @can('borrar-all')
                                            @if ($recaudos->vasolicitude_id)
                                                <button type="button" title="Eliminar Todo" class="btn btn-danger btn-sm me-2 deleteRecaudos"
                                                    data-vasolicitude-id="{{ $recaudos->vasolicitude_id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                            @endcan
                                        </center>
                                    @endif
                            </div>
                        </div>
                    </div>
                @stop


                @section('js')
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                    <script>
                        document.querySelectorAll('.deleteRecaudos').forEach(function(button) {
                            button.addEventListener('click', function() {
                                var recaudosId = this.dataset.vasolicitudeId;

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
                                        fetch('{{ route('vasolicitud.destroy', ':id') }}'.replace(':id',
                                                recaudosId), {
                                                method: 'DELETE',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                }
                                            })
                                            .then(function(response) {
                                                if (response.ok) {
                                                    console.log('Recaudos eliminados correctamente');
                                                    Swal.fire(
                                                        '¡Eliminado!',
                                                        'Los recaudos han sido eliminados.',
                                                        'success'
                                                    ).then(() => {
                                                        window.location.reload();
                                                    });
                                                } else {
                                                    console.error('Error al eliminar los recaudos');
                                                    Swal.fire(
                                                        '¡Error!',
                                                        'No se pudieron eliminar los recaudos.',
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


                        //Aqui es para eliminar de uno a uno los recaudos


                        document.querySelectorAll('.deleteRecaudo').forEach(function(button) {
                            button.addEventListener('click', function() {
                                var recaudosId = this.dataset.vasolicitudeId;

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
                                        fetch('{{ route('vasolicitud.destroyOne', ':id') }}'.replace(':id',
                                                recaudosId), {
                                                method: 'DELETE',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                }
                                            })
                                            .then(function(response) {
                                                if (response.ok) {
                                                    console.log('Recaudos eliminados correctamente');
                                                    Swal.fire(
                                                        '¡Eliminado!',
                                                        'El recaudo han sido eliminado.',
                                                        'success'
                                                    ).then(() => {
                                                        window.location.reload();
                                                    });
                                                } else {
                                                    console.error('Error al eliminar los recaudos');
                                                    Swal.fire(
                                                        '¡Error!',
                                                        'No se pudieron eliminar los recaudos',
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
