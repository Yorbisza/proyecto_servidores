@extends('panel.template')

@section('css')

@stop

@section('title', 'Ver Certificados')

@section('content_header')
    <h1>Consulta de Certificados Asociados a la Embarcación.</h1>
@stop

@section('content')
    <p>Certificados Seguridad Marítima.</p>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <strong>¡Revise los campos!</strong>
                @foreach ($errors->all() as $error)
                    <span class="badge badge-danger">{{ $error }}</span>
                @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
         @endif

            <hr><strong><center>DATOS DEL BUQUE</center></strong><hr>

                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Puerto de Registro</th>
                            <th>Nombre del Buque</th>
                            <th>Distintivo de Llamada</th>
                            <th>Matricula</th>
                            <th>Nro Omi</th>
                            <th>Eslora</th>
                            <th>Arqueo Bruto</th>
                            <th>Tipo de Destinación</th>

                        </tr>
                    </thead>
                </thead>
                <tbody>

                <tr>
                    <td>{{ $sgm->puerto_registro }} </td>
                    <td>{{ $sgm->nombre_buque }} </td>
                    <td>{{ $sgm->distintivo }}</td>
                    <td>{{ $sgm->matricula }} </td>
                    <td>{{ $sgm->nro_omi }} </td>
                    <td>{{ $sgm->eslora_total }}</td>
                    <td>{{ $sgm->arqueo_bruto }}</td>
                   <td>{{ $sgm->tipo_destinacion }}</td>
                </tr>

                </tbody>
             </table>

            <hr><strong><center>DATOS DEL PROPIETARIO</center></strong><hr>

                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cédula/RIF</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>
                </thead>

                <tbody>
                @foreach ($propietarios as $prop)
                    <tr>
                        <td>{{$prop->propietario_armador}} </td>
                        <td>{{$prop->cedula_rif}} </td>
                        <td>{{$prop->num_telefono}} </td>
                </tr>
                @endforeach
                </tbody>
             </table>


            <hr><strong><center>DATOS DEL CERTIFICADO</center></strong><hr>

            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre certificado</th>
                        <th>Número de certificado</th>
                        <th>Número ISMM</th>
                        <th>Fecha de Emisión</th>
                        <th>Fecha vencimiento</th>
                        <th>Potencia de Motor</th>
                        <th>Capacidad de personas</th>
                    </tr>
                </thead>
            </thead>

            <tbody>
            @foreach ($certificados as $cert)
                <tr>
                    <td>{{$cert->nombre_certificado}} </td>
                    <td>{{$cert->numero_certificado}} </td>
                    <td>{{$cert->numero_ismm}} </td>
                    <td>{{$cert->fecha_expedicion}} </td>
                    <td>{{$cert->fecha_vencimiento}} </td>
                    <td>{{$cert->potencia_kw}} </td>
                    <td>{{$cert->capacidad_personas}} </td>
                </tr>
            @endforeach
            </tbody>
         </table>
        </div>
    </div>
@stop

@section('js')

@stop
