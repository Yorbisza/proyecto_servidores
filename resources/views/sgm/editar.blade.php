@extends('panel.template')

@section('css')

@stop

@section('title', 'ver')

@section('content_header')
    <h1>Consulta de Certificados Asociados a la Embarcación.</h1>
@stop

@section('content')
    <p>Certificados Seguridad Marítima.</p>

    <div class="card">
        <div class="card-body">
            <!--SCRIP PARA MOSTRAR Y OCULTAR CHECKBOX-->

            <script type="text/javascript">
                function showContent() {
                    alert('hola');
                    element = document.getElementById("certificado");
                    check = document.getElementById("check");
                    if (check.checked) {
                        element.style.display='block';
                    }
                    else {
                        element.style.display='none';
                    }
                }


            </script>

<div class="row">
<div class="col-lg-12">
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
            <input type="hidden" id="ruta" value="{{route('BuquesPropietariosDestroy', $id)}}">
    <form action="{{ route('sgm.update', $id) }}" method="POST">
        @csrf
        @method('PUT')
        <!--DATOS DEL BUQUE-->
        <hr><strong><center>DATOS DEL BUQUE</center></strong><hr>

        <div class="row">

            <div class="col-xs-4 col-sm-12 col-md-4">
                <div class="form-group">
                   <label for="titulo">Puerto de Registro :</label>
                  <!-- <input type="text" name="puerto_registro" required placeholder="Puerto de Registro" class="form-control"> -->
                  <select class="form-control" name="puerto_registro" id="lista">

                  <option value="MARACAIBO">MARACAIBO</option>
                  <option value="LAS PIEDRAS">LAS PIEDRAS</option>
                  <option value="PUERTO LA CRUZ">PUERTO LA CRUZ</option>
                  <option value="CARUPANO">CARUPANO</option>
                  <option value="PAMPATAR">PAMPATAR</option>
                  <option value="PUERTO CABELLO">PUERTO CABELLO</option>
                  <option value="CARIPITO">CARIPITO</option>
                  <option value="PUERTO SUCRE">PUERTO SUCRE</option>
                  <option value="CIUDAD BOLIVAR">CIUDAD BOLIVAR</option>
                  <option value="GUIRIA">GUIRIA</option>
                  <option value="CIUDAD GUAYANA">CIUDAD GUAYANA</option>
                  <option value="APURE">APURE</option>
                  <option value="AMAZONAS">AMAZONAS</option>
                  <option value="MIRANDA">MIRANDA</option>
                  <option value="SEDE CENTRAL">SEDE CENTRAL</option>
                  <option value="LA VELA DE CORO">LA VELA DE CORO</option>
                  <option value="LA CEIBA">LA CEIBA</option>
                  <option value="DELTA AMACURO">DELTA AMACURO</option>
                </select>
                </div>
            </div>

          <!--  <div class="col-xs-4 col-sm-12 col-md-4">
                <div class="form-group">
                   <label for="titulo">Número de Correlativo :</label>
                   <input type="text" name="nro_correlativo" placeholder="Numero de Correlativo" class="form-control">
                </div>
            </div> -->

            <div class="col-xs-4 col-sm-12 col-md-4">
                <div class="form-group">
                   <label for="titulo">Nombre del Buque :</label>
                   <input type="text" name="nombre_buque" class="form-control" value='{{$buque->nombre_buque}} '>
                </div>
            </div>

            <div class="col-xs-3 col-sm-12 col-md-3">
                <div class="form-group">
                   <label for="titulo">Distintivo de Llamada :</label>
                   <input type="text" name="distintivo" class="form-control"  value="{{$buque->distintivo}}">
                </div>
            </div>
            @php

            $mat=explode('-',$buque->matricula);

        @endphp

            <div class="col-xs-2 col-sm-12 col-md-2">
                <div class="form-group">
                @php
                    $siglas = [
                            "AJZL" => "MARACAIBO (AJZL)",
                            "AMMT" => "LAS PIEDRAS (AMMT)",
                            "AGSI" => "LA GUAIRA (AGSI)",
                            "AGSP" => "PUERTO LA CRUZ (AGSP)",
                            "ADSS" => "CARUPANO (ADSS)",
                            "ARSH" => "PAMPATAR (ARSH)",
                            "ARSH" => "PUERTO CABELLO (ADKN)",
                            "ARSJ" => "CARIPITO (ARSJ)",
                            "APNN" => "PUERTO SUCRE (APNN)",
                            "ABXI" => "CIUDAD BOLIVAR (ABXI)",
                            "ARSI" => "GUIRIA (ARSI)",
                            "ARSK" => "CIUDAD GUAYANA (ARSK)",
                            "ARSM" => "APURE (ARSM)",
                            "ARSL" => "AMAZONAS (ARSL)",
                            "AGSM" => "MIRANDA (AGSM)",
                            "SEDE" => "SEDE CENTRAL (SEDE)",
                            "AQYM" => "LA VELA DE CORO (AQYM)",
                            "ACGL" => "LA CEIBA (ACGL)",
                            "ADAR" => "DELTA AMACURO (ADAR)",

                        ];

                @endphp

                   <label for="titulo">Siglas :</label>
                <!--   <input type="text" name="matricula" required minlength="7" class="form-control"> -->
                    <select class="form-control" name="siglas" id="siglas">
                        @foreach ($siglas as $key => $value)

                                @php
                                if($mat[0]==$key)   {
                                    $selected='selected';
                                }else{
                                    $selected='';
                                }

                                @endphp

                            <option value="{{$key}} " {{$selected}}>{{$value}}</option>

                        @endforeach
                   </select>
                </div>
            </div>



            <div class="col-xs-1 col-sm-12 col-md-1">
                    <label for="titulo">Destinacion :</label>
                    <select class="form-control" name="destinacion" id="destinacion">
                        @php
                            if($mat[1]=='RE'){
                                $re='selected';
                                $de='';
                            }else{
                                $re='';
                                $de='selected';
                            }
                        @endphp
                    <option value="RE" $re>RE</option>
                    <option value="DE" $de>DE</option>
                   </select>
            </div>

            <div class="col-xs-1 col-sm-12 col-md-1">
                    <label for="titulo">Numero :</label>
                    <input type="text" name="numero_matricula" class="form-control" id="numero_matricula"  value="{{$mat[2]}} " >
                   </select>
            </div>

            <div class="col-xs-3 col-sm-12 col-md-3">
                <div class="form-group">
                   <label for="titulo">número omi :</label>
                   <input type="text" name="nro_omi" class="form-control" value="{{$buque->nro_omi}}"  >
                </div>
            </div>

            <div class="col-xs-3 col-sm-12 col-md-3">
                <div class="form-group">
                   <label for="titulo">Eslora :</label>
                   <input type="number" step="0.01" min="0" name="eslora_total" class="form-control" value="{{$buque->eslora_total}}">
                </div>
            </div>
            <div class="col-xs-3 col-sm-12 col-md-3">
                <div class="form-group">
                   <label for="titulo">Arqueo Bruto :</label>
                   <input type="number" step="0.01" min="0" name="arqueo_bruto" class="form-control" value="{{$buque->arqueo_bruto}}">
                </div>
            </div>

            <div class="col-xs-3 col-sm-12 col-md-3">
                <div class="form-group">
                   <label for="titulo">Tipo de Destinación :</label>
                   <select class="form-control" name="tipo_destinacion" id="tipo_destinacion">
                    @php
                            if($buque->tipo_destinacion=='RECREO'){
                                $recreo='selected';
                                $dep='';
                            }else{
                                $recreo='';
                                $dep='selected';
                            }
                        @endphp
                    <option value="RECREO" {{$recreo}}>RECREO</option>
                    <option value="DEPORTIVO" {{$dep}} >DEPORTIVO</option>
                   </select>
                </div>
            </div>

        </div>

         <!--DATOS DEL PROPIETARIO-->
         <hr><strong><center>DATOS DEL PROPIETARIO</center></strong><hr>

         <div class="row" id="divPropietarios" data-count='1'>

             @php   $var=0; @endphp
{{$propietarios}}
             @foreach ($propietarios as $prop)
             @php      $var++;   @endphp


                    <div class="row" id="propietario_{{$var}}">
                        <input type="hidden"  name="propietarioid_{{$var}}" class="form-control" value="{{ $prop->id}}">
                        <input type="hidden"  name="buquepropietarioid_{{$var}}" class="form-control" value="{{ $prop->buque_propietario_id}}">

                    <div class="col-xs-4 col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="titulo">Popietario Armador :</label>
                            <input type="text" name="propietario_armador_{{$var}}" required class="form-control" value="{{$prop->propietario_armador}}">
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="titulo">Cedula o Rif :</label>
                            <input type="text" name="cedula_rif_{{$var}}" class="form-control"  value="{{$prop->cedula_rif}}">
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="titulo">Número de Telefono :</label>
                            <input type="number"  name="num_telefono_{{$var}}" class="form-control" value="{{ $prop->num_telefono}}">
                        </div>
                    </div>
                        @if (count($propietarios)>1 && $var==1)
                            <div class="col-md-1 pt-4"><input type="button" class="btn btn-success" id="add" onClick="addPropietario(0)" value="+" /></div>

                        @else
                        <div class="col-md-1 pt-4"><input type="button" class="btn btn-danger" id="add" onClick="deletePropietario({{$var}}, {{$prop->buque_propietario_id}})" value="-" /></div>
                        @endif

                </div>
             @endforeach

             <input type="hidden" name="cuantos" id="cuantos" value="{{$var}}">
         </div>

        <hr><strong><center>DATOS DEL CERTIFICADO</center></strong><hr>


   <!--SCRIP PARA MOSTRAR Y OCULTAR CHECKBOX-->

        <div class="row">

        <script type="text/javascript">
            function showContent() {
                element = document.getElementById("content");
                check = document.getElementById("check");
                if (check.checked) {
                    element.style.display='block';
                }
                else {
                    element.style.display='none';
                }
            }

            function muestra_oculta(id){
            //alert(id);
            if (document.getElementById){ //se obtiene el id
            var el = document.getElementById(id); //se define la variable "el" igual a nuestro div

            if(id==1){
                el.style.display = (el.style.display == 'none') ? 'block' : 'none';
                element2=2;
                element2.style.display='none';
                element=3;
                element3.style.display='none';

            }else if (id==2){
                el.style.display = (el.style.display == 'none') ? 'block' : 'none';
                element2=1;
                element2.style.display='none';
                element=3;
                element3.style.display='none';

            }else if(id==3){
                el.style.display = (el.style.display == 'none') ? 'block' : 'none';
                element2=2;
                element2.style.display='none';
                element=1;
                element3.style.display='none';

            }
           // el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
            }
            }
            window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
            if(id==1){
            muestra_oculta('1');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
            }else if (id==2){
            muestra_oculta('2');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
            }else if(id==3){
            muestra_oculta('3');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
            }
            }
        </script>

        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                   <label for="titulo">Nombre del Certificado</label><br>
                    @php
                    $i=0;
                    $i2=0;


                    @endphp
                   @foreach ($tipo_certificado as $tc)
                        @php


                            $i++;
                        @endphp
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                @php
                                    if($certificados[$i2]['tipos_certificados_id']==$tc->id){
                                        $checkTC1='checked';
                                    }else{
                                        $checkTC1='';
                                    }
                                @endphp
                            <input type="checkbox" name="certificado{{$i}}" id="certificado{{$i}}" onClick="muestra_oculta(this.value)"  {{$checkTC1}} value="{{$tc->id}}"> <B>{{$tc->nombre_certificado}}</B>
                                    {{$certificados[$i2]['tipos_certificados_id']}}
                        </div>
                        @if($tc->id==1)
                            @if($certificados[$i2]['tipos_certificados_id']==$tc->id)
                            Active1
                            <div id="1" style="display: block;">
                                <p>01</p>
                                <input type="hidden" name="idcert1" value="{{$certificados[$i2]['id']}}">
                                <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Número de Certificado :</label>
                                <input type="text"  name="numero_certificado{{$i}}" placeholder="" class="form-control" value='{{$certificados[$i2]['numero_certificado']}}'>
                                </div>
                                </div>
                                <div class="col-xs-4 col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="titulo">Potencia KW :</label>
                                    <input type="number" step="0.01" min="0" name="potencia_kw{{$i}}"  class="form-control" value='{{$certificados[$i2]['potencia_kw']}}'>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="titulo">Capacidad de Personas :</label>
                                    <input type="text"  name="capacidad_personas{{$i}}" class="form-control" value='{{$certificados[$i2]['capacidad_personas']}}'>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-12 col-md-2">
                                    <div class="form-group">
                                    <label for="titulo">Fecha de Expedición</label>
                                    <input type="date" name="fecha_expedicion{{$i}}" class="form-control" value='{{$certificados[$i2]['fecha_expedicion']}}'>
                                </div>
                                </div>
                                <div class="col-xs-2 col-sm-12 col-md-2">
                                    <div class="form-group">
                                    <label for="titulo">Fecha Vencimiento</label>
                                    <input type="date" name="fecha_vencimiento{{$i}}" class="form-control" value='{{$certificados[$i2]['fecha_vencimiento']}}'>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-12 col-md-4">
                                    <div class="form-floating">
                                    <label for="contenido">Observaciones :</label>
                                    <textarea class="form-control" name="observaciones{{$i}}" style="height: 100px">
                                        {{$certificados[$i2]['observaciones']}}
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                            @else
                            Active1
                            <div id="1" style="display: block;">
                                <p>01</p>
                                <input type="hidden" name="idcert1" value="0">
                                <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Número de Certificado :</label>
                                <input type="text"  name="numero_certificado{{$i}}" placeholder="" class="form-control" >
                                </div>
                                </div>
                                <div class="col-xs-4 col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="titulo">Potencia KW :</label>
                                    <input type="number" step="0.01" min="0" name="potencia_kw{{$i}}"  class="form-control" >
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="titulo">Capacidad de Personas :</label>
                                    <input type="text"  name="capacidad_personas{{$i}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-12 col-md-2">
                                    <div class="form-group">
                                    <label for="titulo">Fecha de Expedición</label>
                                    <input type="date" name="fecha_expedicion{{$i}}" class="form-control" >
                                </div>
                                </div>
                                <div class="col-xs-2 col-sm-12 col-md-2">
                                    <div class="form-group">
                                    <label for="titulo">Fecha Vencimiento</label>
                                    <input type="date" name="fecha_vencimiento{{$i}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-12 col-md-4">
                                    <div class="form-floating">
                                    <label for="contenido">Observaciones :</label>
                                    <textarea class="form-control" name="observaciones{{$i}}" style="height: 100px"></textarea>
                                    </div>
                                </div>
                            </div>
                            @endif

                        @endif
                        @if($tc->id==2)
                            @if($certificados[$i2]['tipos_certificados_id']==$tc->id)
                            Active2
                            <div id="2" style="display: block;">
                                <p>02</p>
                                <input type="hidden" name="idcert2" value="{{$certificados[$i2]['id']}}">

                                <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Número de Certificado :</label>
                                <input type="text"  name="numero_certificado{{$i}}" placeholder="" class="form-control"  value='{{$certificados[$i2]['numero_certificado']}}'>
                                </div>
                                </div>
                                <div class="col-xs-2 col-sm-12 col-md-2">
                                    <div class="form-group">
                                    <label for="titulo">Fecha de Expedición</label>
                                    <input type="date" name="fecha_expedicion{{$i}}" class="form-control" value='{{$certificados[$i2]['fecha_expedicion']}}'>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-12 col-md-2">
                                    <div class="form-group">
                                    <label for="titulo">Fecha Vencimiento</label>
                                    <input type="date" name="fecha_vencimiento{{$i}}" class="form-control" value='{{$certificados[$i2]['fecha_vencimiento']}}'>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-12 col-md-4">
                                    <div class="form-floating">
                                    <label for="contenido">Observaciones :</label>
                                    <textarea class="form-control" name="observaciones{{$i}}" style="height: 100px">
                                            {{$certificados[$i2]['observaciones']}}
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                            @else
                            Active2
                            <div id="2" style="display: block;">
                                <p>02</p>
                                <input type="hidden" name="idcert2" value='0'>

                                <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Número de Certificado :</label>
                                <input type="text"  name="numero_certificado{{$i}}" placeholder="" class="form-control"  >
                                </div>
                                </div>
                                <div class="col-xs-2 col-sm-12 col-md-2">
                                    <div class="form-group">
                                    <label for="titulo">Fecha de Expedición</label>
                                    <input type="date" name="fecha_expedicion{{$i}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-12 col-md-2">
                                    <div class="form-group">
                                    <label for="titulo">Fecha Vencimiento</label>
                                    <input type="date" name="fecha_vencimiento{{$i}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-12 col-md-4">
                                    <div class="form-floating">
                                    <label for="contenido">Observaciones :</label>
                                    <textarea class="form-control" name="observaciones{{$i}}" style="height: 100px"></textarea>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                        @if($tc->id==3)
                            @if($certificados[$i2]['tipos_certificados_id']==$tc->id)
                            Active3
                            <div id="3" style="display: block;">
                                <p>03</p>
                                <input type="hidden" name="idcert3" value="{{$certificados[$i2]['id']}}">

                            <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Número de Certificado :</label>
                                <input type="text"  name="numero_certificado{{$i}}" placeholder="" class="form-control" value='{{$certificados[$i2]['numero_certificado']}}'>
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Número ISMM :</label>
                                <input type="text"  name="numero_ismm{{$i}}" placeholder="" class="form-control" value='{{$certificados[$i2]['numero_ismm']}}'>
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Fecha de Expedición</label>
                                <input type="date" name="fecha_expedicion{{$i}}" class="form-control" value='{{$certificados[$i2]['fecha_expedicion']}}'>
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Fecha Vencimiento</label>
                                <input type="date" name="fecha_vencimiento{{$i}}" class="form-control" value='{{$certificados[$i2]['fecha_vencimiento']}}'>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-12 col-md-4">
                                <div class="form-floating">
                                <label for="contenido">Observaciones :</label>
                                <textarea class="form-control" name="observaciones{{$i}}" style="height: 100px">
                                    {{$certificados[$i2]['observaciones']}}
                                </textarea>
                                </div>
                            </div>
                            </div>
                            @else
                            Active3
                            <div id="3" style="display: block;">
                                <p>03</p>
                                <input type="hidden" name="idcert3" value="0">

                            <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Número de Certificado :</label>
                                <input type="text"  name="numero_certificado{{$i}}" placeholder="" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Número ISMM :</label>
                                <input type="text"  name="numero_ismm{{$i}}" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Fecha de Expedición</label>
                                <input type="date" name="fecha_expedicion{{$i}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                <label for="titulo">Fecha Vencimiento</label>
                                <input type="date" name="fecha_vencimiento{{$i}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-12 col-md-4">
                                <div class="form-floating">
                                <label for="contenido">Observaciones :</label>
                                <textarea class="form-control" name="observaciones{{$i}}" style="height: 100px"></textarea>
                                </div>
                            </div>
                            </div>
                            @endif

                        @endif

                        </div>
                    <br> <hr>
                        @php
                        if($i2<(count($certificados)-1)){
                            $i2++;
                        }

                        @endphp

                        @endforeach
                </div>
            </div>
            <hr>
        </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
        </div>
    </div>
@stop

@section('js')

@stop
