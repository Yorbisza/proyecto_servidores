
<form action="{{ route('sgm.destroy',$id) }}" method="POST">

@can('crear-sgm')
    <a class="btn btn-success" title="Agregar certificados" href="{{ route('createCert',$id) }}"><i class="fa fa-plus"></i></a>
@endcan

@can('ver-sgm')
    <a class="btn btn-info"  title="Consultar certificados" href="{{ route('certificados.show',$id) }}"><i class="fa fa-eye"></i></a>
@endcan

@can('editar-sgm')
    <a class="btn btn-warning"  title="Modificar certificados" href="{{ route('certificados.edit',$id) }}"><i class="fas fa-pencil-alt"></i></a>
@endcan
@csrf

</form>
