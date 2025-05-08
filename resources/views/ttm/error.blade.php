@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@stop

@section('title', 'Solicitud')

@section('content_header')
    <center>
        <h1 class="alert altert-danger">SOLICITUD NO ENCONTRADA</h1>
    </center>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
         <h3 class="alert alert-warning text-center"> El número de solicitud ingresado no existe <i class="fas fa-exclamation-circle"></i> </h3>
         <a href="../ttm" > <h2 class="text-center"> Volver  <i class="fas fa-backspace"></i></h2></a>
    </div>
    </div>


@stop

