@extends('panel.template')

@section('css')

@stop

@section('title', 'crear')

@section('content_header')
    <h1>Agregar Certificado Seguridad Marítima</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración de Seguridad Marítima.</p>

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

                    <form action="{{ route('sgm.store') }}" method="POST">
                        @csrf
                        <!--DATOS DEL BUQUE-->
                        <hr><strong><center>DATOS DEL BUQUE</center></strong><hr>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12" >
                               <b>MATRÍCULA</b>
                            </div>
                        <div class="col-xs-2 col-sm-12 col-md-2">
                                <div class="form-group">
                                   <label for="titulo">Siglas :</label>
                                <!--   <input type="text" name="matricula" required minlength="7" class="form-control"> -->
                                    <select class="form-control" name="siglas" id="siglas">
                                    <option value="AJZL">MARACAIBO (AJZL)</option>
                                    <option value="AMMT">LAS PIEDRAS (AMMT)</option>
                                    <option value="AGSI">LA GUAIRA (AGSI)</option>
                                    <option value="AGSP">PUERTO LA CRUZ (AGSP)</option>
                                    <option value="ADSS">CARUPANO (ADSS)</option>
                                    <option value="ARSH">PAMPATAR (ARSH)</option>
                                    <option value="ADKN">PUERTO CABELLO (ADKN)</option>
                                    <option value="ARSJ">CARIPITO (ARSJ)</option>
                                    <option value="APNN">PUERTO SUCRE (APNN) </option>
                                    <option value="ABXI">CIUDAD BOLIVAR (ABXI)</option>
                                    <option value="ARSI">GUIRIA (ARSI)</option>
                                    <option value="ARSK">CIUDAD GUAYANA (ARSK)</option>
                                    <option value="ARSM">APURE (ARSM)</option>
                                    <option value="ARSL">AMAZONAS (ARSL)</option>
                                    <option value="AGSM">MIRANDA (AGSM)</option>
                                    <option value="SEDE">SEDE CENTRAL (SEDE)</option>
                                    <option value="AQYM">LA VELA DE CORO (AQYM)</option>
                                    <option value="ACGL">LA CEIBA (ACGL)</option>
                                    <option value="ADAR">DELTA AMACURO (ADAR)</option>
                                   </select>
                                </div>
                            </div>

                            <div class="col-xs-1 col-sm-12 col-md-1">
                                    <label for="titulo">Destinacion :</label>
                                    <select class="form-control" name="destinacion" id="destinacion">
                                    <option value="RE">RE</option>
                                    <option value="DE">DE</option>
                                   </select>
                            </div>

                            <div class="col-xs-1 col-sm-12 col-md-1">

                                    <input type="number" name="numero_matricula" class="form-control" id="numero_matricula">
                                   </select>
                            </div>

                            <div class="col-xs-1 col-sm-12 col-md-1 pt-4">
                                <button type="button" class="btn btn-primary">Buscar</button>
                            </div>

                        </div>

                        <!--DATOS DEL BUQUE-->
                        <hr><strong><center>DATOS DEL PROPIETARIO</center></strong><hr>

                        <div class="row">
                        <div class="row" id="divPropietarios" data-count='1'>
                            <input type="hidden" name="cuantos" id="cuantos" value='1'>
                            <div class="row" id="propietario_1">

                                <div class="col-xs-4 col-sm-12 col-md-4">
                                    <div class="form-group">
                                       <label for="titulo">Popietario Armador :</label>
                                       <input type="text" name="propietario_armador_1" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-xs-3 col-sm-12 col-md-3">
                                    <div class="form-group">
                                       <label for="titulo">Cedula o Rif :</label>
                                       <input type="text" name="cedula_rif_1" class="form-control">
                                    </div>
                                </div>

                                <div class="col-xs-4 col-sm-12 col-md-4">
                                    <div class="form-group">
                                       <label for="titulo">Número de Telefono :</label>
                                       <input type="number"  name="num_telefono_1" class="form-control">
                                    </div>
                                </div>

                                    <div class="col-md-1 pt-4"><input type="button" class="btn btn-success" id="add" onClick="addPropietario(1)" value="+" /></div>

                            </div>
                           </div>
                        </div>

                        <!-- jAVA SCRIPT-->

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
                                    @endphp
                                   @foreach ($tipo_certificado as $tc)
                                        @php
                                            $i++;
                                        @endphp
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                            <input type="checkbox" name="certificado{{$i}}" id="certificado{{$i}}" onClick="muestra_oculta(this.value)"   value="{{$tc->id}}"> <B>{{$tc->nombre_certificado}}</B>
                                        </div>

                                        @if($tc->id==1)

                                       <!-- Active1-->
                                        <div id="1" style="display: none;">
                                          <!--  <p>01</p>-->
                                            <div class="col-xs-2 col-sm-12 col-md-2">
                                             <div class="form-group">
                                                <label for="titulo">Número de Certificado :</label>
                                                <input type="text"  name="numero_certificado{{$i}}" placeholder="" class="form-control">
                                             </div>
                                            </div>

                                            <div class="col-xs-4 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                   <label for="titulo">Potencia KW:</label>
                                                   <input type="number" step="0.04" min="0" name="potencia_kw{{$i}}"  class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-xs-4 col-sm-12 col-md-4">
                                                <div class="form-group">
                                                   <label for="titulo">Capacidad de Personas :</label>
                                                   <input type="text"  name="capacidad_personas{{$i}}" class="form-control">
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
                                        @if($tc->id==2)
                                          <!--   Active2 -->
                                        <div id="2" style="display: none;">

                                            <div class="col-xs-2 col-sm-12 col-md-2">
                                              <div class="form-group">
                                                <label for="titulo">Número de Certificado :</label>
                                                <input type="text"  name="numero_certificado{{$i}}" placeholder="" class="form-control">
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
                                        @if($tc->id==3)
                                       <!-- Active3-->
                                        <div id="3" style="display: none;">

                                        <div class="col-xs-2 col-sm-12 col-md-2">
                                            <div class="form-group">
                                               <label for="titulo">Número de Certificado :</label>
                                               <input type="text"  name="numero_certificado{{$i}}" placeholder="" class="form-control">
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

                                        </div>
                                    <br>
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
