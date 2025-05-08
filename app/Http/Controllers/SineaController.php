<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;

class SineaController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-sinea|crear-sinea|editar-sinea|borrar-sinea', ['only' => ['index']]);
        $this->middleware('permission:crear-sinea', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-sinea', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-sinea', ['only' => ['destroy']]);
    }

    public function solicitudes($id)
    {
        $campos = array(':nro_solicitud' => $id);

        $solicitudes = Solicitud::whereRaw("gemar.solicitudes.nro_solicitud = :nro_solicitud", $campos)
                        ->leftJoin('gemar.ctrl_documentos', 'gemar.solicitudes.id', '=', 'gemar.ctrl_documentos.solicitud_id')
                        ->join('public.solicitantes', 'gemar.solicitudes.solicitante_id', '=', 'public.solicitantes.id')
                        ->join('public.capitanias', 'gemar.solicitudes.capitania_id', '=', 'public.capitanias.id')
                        ->get();

        return view('sinea.index', ['solicitudes' => $solicitudes]);
    }

    public function index()
    {
        return view('sinea.index');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
