function addPropietario(opt){
    if(opt==1){
        let param='';
    }else{
        let param='edit';

    }
    let cuantos=document.getElementById('divPropietarios').getAttribute('data-count');
    cuantos++;
    document.getElementById('divPropietarios').setAttribute('data-count', cuantos);
    document.getElementById('cuantos').value=cuantos;

    var div = document.createElement('div');
    div.setAttribute('class', 'row');
    div.setAttribute('id', 'propietario_'+cuantos);
    div.innerHTML=`
        <div class="col-xs-4 col-sm-12 col-md-4">
        <div class="form-group">
           <label for="titulo">Popietario Armador :</label>
           <input type="text" name="propietario_armador_`+cuantos+`" required class="form-control">
        </div>
    </div>

    <div class="col-xs-3 col-sm-12 col-md-3">
        <div class="form-group">
           <label for="titulo">Cedula o Rif :</label>
           <input type="text" name="cedula_rif_`+cuantos+`" class="form-control">
        </div>
    </div>

    <div class="col-xs-4 col-sm-12 col-md-4">
        <div class="form-group">
           <label for="titulo">Número de Telefono :</label>
           <input type="number"  name="num_telefono_`+cuantos+`" class="form-control">
        </div>
    </div>

        <div class="col-md-1 pt-4"><input type="button" class="btn btn-danger" id="add" onClick="deletePropietario(`+cuantos+`, 0)" value="-" /></div>
    `;

let divPadre=document.getElementById('divPropietarios');
divPadre.appendChild(div);

}

function deletePropietario(num, id){
    if(id!=0){


       // let div=document.getElementById('propietario_'+num);
        //div.remove();

        let ruta=document.getElementById('ruta').value;

        $.ajax({
            url: ruta,
            data: {id: id }

        })// This will be called on success
            .done(function (response) {

                respuesta = JSON.parse(response);

                 console.log(respuesta);
            })

            // This will be called on error
            .fail(function (response) {
                console.log("fallo al buscar ");
            });


    }else{
        let div=document.getElementById('propietario_'+num);
        div.remove();
    }


}

function muestra_oculta(id){
    var el = document.getElementById(id); //se define la variable "el" igual a nuestro div

    el.style.display = (el.style.display == 'none') ? 'block' : 'none';
}


//validacion de campos de certificados

function validacion(evt) {
    evt.preventDefault();

    let cert1=document.getElementById('certificado1').checked;
    let cert2=document.getElementById('certificado2').checked;
    let cert3=document.getElementById('certificado3').checked;
    let msj=document.getElementById('msj');
    let bandera=true;

    if(cert1==true){


        numero_certificado1=document.getElementById('numero_certificado1').value;
        potencia_kw1=document.getElementById('potencia_kw1').value;
        capacidad_personas1=document.getElementById('capacidad_personas1').value;


        distintivo1=document.getElementById('distintivo1').value;
        tipo_buque1=document.getElementById('tipo_buque1').value;
        serial_casco1=document.getElementById('serial_casco1').value;
        marca1=document.getElementById('marca1').value;
        modelo1=document.getElementById('modelo1').value;
       // consola_central1=document.getElementById('consola_central1').value;

        numero_cilindros1=document.getElementById('numero_cilindros1').value;
        marca_nombre_fabricante1=document.getElementById('marca_nombre_fabricante1').value;
        velocidad1=document.getElementById('velocidad1').value;
        potencia_total1=document.getElementById('potencia_total1').value;
        /*clase1=document.getElementById('clase1').value;
        motores1=document.getElementById('motores1').value;
        num_serial1=document.getElementById('num_serial1').value;*/



        fecha_expedicion1=document.getElementById('fecha_expedicion1').value;
        fecha_vencimiento1=document.getElementById('fecha_vencimiento1').value;
        observaciones1=document.getElementById('observaciones1').value;

        if(numero_certificado1==""  && bandera==true){

            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>número de certificado</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }



        if(capacidad_personas1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>capacidad de personas</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(isNaN(capacidad_personas1)  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>capacidad de personas</b> es debe ser numérico, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }
/*
        if(distintivo1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Distintivo de llamada</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }*/

        if(tipo_buque1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Tipo de buque</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }


        if(serial_casco1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Serial del casco</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(marca1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Marca</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }
        if(modelo1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Modelo</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        /*if(consola_central1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Consola central</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }*/



        if(numero_cilindros1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Número de cilindros de propulsión</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(isNaN(numero_cilindros1)  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Número de cilindros</b> debe ser numérico, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        /*if(clase1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Marca o nombre del fabricante</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }*/

        if(marca_nombre_fabricante1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Marca o nombre del fabricante</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(velocidad1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Velocidad</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(potencia_kw1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Potencia KW</b>es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }


        if(isNaN(potencia_kw1)  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Potencia KW</b> debe ser numérico, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(potencia_total1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Potencia total</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(isNaN(potencia_total1)  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Potencia Total</b> debe ser numérico, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }


        if(fecha_expedicion1=="" && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Fecha de expedición</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(fecha_vencimiento1==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN LICENCIA DE NAVEGACIÓN: El campo <b>Fecha de vencimiento</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }


    }

    if(cert2==true){
        numero_certificado2=document.getElementById('numero_certificado2').value;

        puerto_registro2=document.getElementById('puerto_registro2').value;
        zona_maritima_operacion2=document.getElementById('zona_maritima_operacion2').value;
        tipo_buque2=document.getElementById('tipo_buque2').value;

        distintivo2=document.getElementById('distintivo2').value;


        fecha_expedicion2=document.getElementById('fecha_expedicion2').value;
        fecha_vencimiento2=document.getElementById('fecha_vencimiento2').value;
        observaciones2=document.getElementById('observaciones2').value;

        if(numero_certificado2==""  && bandera==true){

            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFÓNICA: El campo <b>número de certificado</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(puerto_registro2==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFÓNICA: El campo <b>Puerto de registro</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(distintivo2==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFÓNICA: El campo <b>Distintivo de llamada</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(zona_maritima_operacion2==""  && bandera==true){

            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFÓNICA: El campo <b>Zona marítima de operación</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(tipo_buque2==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFÓNICA: El campo <b>Tipo de Buque</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(fecha_expedicion2==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFÓNICA: El campo <b>Fecha de expedición</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(fecha_vencimiento2==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFÓNICA: El campo <b>Fecha de vencimiento</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }


    }

    if(cert3==true){

        numero_certificado3=document.getElementById('numero_certificado3').value;
        numero_ismm3=document.getElementById('numero_ismm3').value;
        fecha_expedicion3=document.getElementById('fecha_expedicion3').value;
        fecha_vencimiento3=document.getElementById('fecha_vencimiento3').value;
        observaciones3=document.getElementById('observaciones3').value;

        if(numero_certificado3==""  && bandera==true){

            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICACIÓN DE ASIGNACIÓN DE NÚMERO ISMM: El campo <b>número de certificado</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(numero_certificado3==""  && bandera==true){

            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICACIÓN DE ASIGNACIÓN DE NÚMERO ISMM: El campo <b>número de certificado</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(fecha_expedicion3==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICACIÓN DE ASIGNACIÓN DE NÚMERO ISMM: El campo <b>Fecha de expedición</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }

        if(fecha_vencimiento3==""  && bandera==true){
            let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">SECCIÓN CERTIFICACIÓN DE ASIGNACIÓN DE NÚMERO ISMM: El campo <b>Fecha de vencimiento</b> es requerido, por favor verifique.</div>';
            msj.innerHTML=m;
            bandera=false;
        }


    }


    if(cert1==false && cert2==false && cert3==false){
        let m='<div class="alert alert-danger alert-dismissible fade show" role="alert">No ha seleccionado un certificado, por favor verifique.</div>';
            msj.innerHTML=m+cert1+" -- "+cert2+" --"+cert3;
            bandera=false;
    }else if(bandera==true){

        document.formCertificados.submit()

    }

    setTimeout(LimpiarMsj, 20000); //20 segundos

  }

  function LimpiarMsj(){
    let msj=document.getElementById('msj');
    msj.innerHTML="";
  }


  function soloNumeros(event){
     console.log(event.keyCode);
    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)  && event.keyCode !==8 && event.keyCode !==9  ){
        return false;
    }
}

function soloNumerosPunto(event)
{
   if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)    && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){ return false; }
  return true;
}


function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}
