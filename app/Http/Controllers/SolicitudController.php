<?php

namespace App\Http\Controllers;

use App\Models\ControlDocumentos;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use App\Models\Capitanias;
use Illuminate\Support\Facades\DB;


class SolicitudController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-solicitud|crear-solicitud|editar-solicitud|borrar-solicitud', ['only' => ['index']]);
        $this->middleware('permission:crear-solicitud', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-solicitud', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-solicitud', ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('solicitud.index');
    }

    /*     public function buscarr(Request $request)
        {
            $nro_solicitud = $request->input('nro_solicitud');

            $solicitud = Solicitud::select(
                'gemar.ctrl_documentos.id as id_doc',
                'gemar.ctrl_documentos.solicitud_id as solicitud_id',
                'gemar.ctrl_documentos.marino_id',
                'gemar.ctrl_documentos.nro_doc',
                'gemar.ctrl_documentos.nro_ctrl',
                'gemar.ctrl_documentos.fecha_emision',
                'gemar.ctrl_documentos.fecha_vencimiento',
                'gemar.ctrl_documentos.fecha_registro',
                'gemar.documentos.id as doc_id',
                'gemar.documentos.nombre as doc_nombre',
                'gemar.solicitudes.id',
                'gemar.solicitudes.nro_solicitud',
                'gemar.solicitudes.capitania_id',
                'gemar.solicitudes.solicitante_id',
                'gemar.solicitudes.documento_id',
                'gemar.solicitudes.status',
                'gemar.solicitudes.tipo_emision',
                'gemar.solicitudes.fecha_solicitud',
                'gemar.solicitudes.created',
                'gemar.solicitudes.modified',
                'gemar.solicitudes.firmada',
                'gemar.solicitudes.pdf_signed',
                'gemar.solicitudes.pdf_signed_user_id',
                'gemar.solicitudes.pdf_signed_sent',
                'gemar.solicitudes.pdf_signed_timestamp',
                'gemar.solicitudes.fecha_firmada_presidente',
                'gemar.solicitudes.fecha_firmada_gerente',
                'gemar.solicitudes.firmada',
                'public.solicitantes.id as id_solicitante',
                'public.solicitantes.rif',
                'public.solicitantes.nombre as nombre_solicitante',
                'public.solicitantes.pnj',
                'public.capitanias.id as capid',
                'public.capitanias.nombre as cap_nombre',
                'public.capitanias.siglas'
            )
                ->from('gemar.solicitudes')
                ->leftJoin('gemar.ctrl_documentos', 'gemar.solicitudes.id', '=', 'gemar.ctrl_documentos.solicitud_id')
                ->join('public.solicitantes', 'gemar.solicitudes.solicitante_id', '=', 'public.solicitantes.id')
                ->join('public.capitanias', 'gemar.solicitudes.capitania_id', '=', 'public.capitanias.id')
                ->join('gemar.documentos', 'gemar.solicitudes.documento_id', '=', 'gemar.documentos.id')
                ->where('gemar.solicitudes.nro_solicitud', $nro_solicitud)
                ->get();


            // print_r($solicitud);
            return view('solicitudes.solicitud', compact('solicitud'));

        }
     */
    public function buscar(Request $request)
    {
        $nro_solicitud = $request->input('nro_solicitud');
        $solicitud = Solicitud::select(
            'gemar.ctrl_documentos.id as id_doc',
            'gemar.ctrl_documentos.solicitud_id as solicitud_id',
            'gemar.ctrl_documentos.marino_id',
            'gemar.ctrl_documentos.nro_doc',
            'gemar.ctrl_documentos.nro_ctrl',
            'gemar.ctrl_documentos.fecha_emision',
            'gemar.ctrl_documentos.fecha_vencimiento',
            'gemar.ctrl_documentos.fecha_registro',
            'gemar.documentos.id as doc_id',
            'gemar.documentos.nombre as doc_nombre',
            'gemar.solicitudes.id',
            'gemar.solicitudes.nro_solicitud',
            'gemar.solicitudes.capitania_id',
            'gemar.solicitudes.solicitante_id',
            'gemar.solicitudes.documento_id',
            'gemar.solicitudes.status',
            'gemar.solicitudes.tipo_emision',
            'gemar.solicitudes.fecha_solicitud',
            'gemar.solicitudes.created',
            'gemar.solicitudes.modified',
            'gemar.solicitudes.firmada',
            'gemar.solicitudes.pdf_signed',
            'gemar.solicitudes.pdf_signed_user_id',
            'gemar.solicitudes.pdf_signed_sent',
            'gemar.solicitudes.pdf_signed_timestamp',
            'gemar.solicitudes.fecha_firmada_presidente',
            'gemar.solicitudes.fecha_firmada_gerente',
            'gemar.solicitudes.firmada',
            'public.solicitantes.id as id_solicitante',
            'public.solicitantes.rif',
            'public.solicitantes.nombre as nombre_solicitante',
            'public.solicitantes.pnj',
            'public.capitanias.id as capid',
            'public.capitanias.nombre as cap_nombre',
            'public.capitanias.siglas'
        )
            ->from('gemar.solicitudes')
            ->leftJoin('gemar.ctrl_documentos', 'gemar.solicitudes.id', '=', 'gemar.ctrl_documentos.solicitud_id')
            ->join('public.solicitantes', 'gemar.solicitudes.solicitante_id', '=', 'public.solicitantes.id')
            ->join('public.capitanias', 'gemar.solicitudes.capitania_id', '=', 'public.capitanias.id')
            ->join('gemar.documentos', 'gemar.solicitudes.documento_id', '=', 'gemar.documentos.id')
            ->where('gemar.solicitudes.nro_solicitud', $nro_solicitud)
            ->get();

        if ($solicitud->isEmpty()) {
            // Si no se encuentra ninguna solicitud, muestra un mensaje de error
            return view('solicitudes.error');

        } else

            return view('solicitudes.solicitud', compact('solicitud'));

    }
    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        if ($solicitud->status >= 7) {
            $documentos = ControlDocumentos::where('solicitud_id', $id)->first();
            $documentos->update($request->all());
        } else {
            $solicitud = Solicitud::findOrFail($id);
            $solicitud->update($request->all());
        }
        $solicitud->update($request->all());


        return redirect()->route('solicitud.index')->with('success', 'Registro actualizado correctamente.');
    }
    public function destroy($id)
    {
        $documento = ControlDocumentos::where('solicitud_id', $id)->first();

        if ($documento) {
            $documento->delete();
            //  return view('solicitudes.index')->with('eliminar', 'ok');
            return redirect()->route('solicitudes.index')->with('eliminar', 'ok');
        } else {
            return response()->json(['error' => 'No se encontró el documento relacionado a la solicitud.'], 404);
        }
    }
}
