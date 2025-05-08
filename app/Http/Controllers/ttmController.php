<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudttm;
use App\Models\Vasolicitudttm;
use App\Models\Valibrottm;
use App\Models\Recaud;
use App\Models\Vaactividadttm;
use App\Models\Vainsdocumentales;
use PHPUnit\Framework\Constraint\IsEmpty;

use function PHPUnit\Framework\isEmpty;

class ttmController extends Controller
{

    public function index()
    {
        return view('ttm.index');
    }
    public function error()
    {
        return view('ttm.error');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function buscar(Request $request)
    {
        $vasolicitud = $request->input('vasolicitud');


        $solicitud = Vasolicitudttm::select(
            'public.solicitantes.user_id',
            'public.solicitantes.nombre',
            'public.solicitantes.rif',
            'public.solicitantes.pnj',
            'vageneral.vaempresaxsolicitudes.id',
            'vageneral.vaempresaxsolicitudes.vasolicitude_id',
            'vageneral.vaempresaxsolicitudes.vaempresa_id',
            'vageneral.vaempresaxsolicitudes.vaactividade_id',
            'vageneral.vaempresaxsolicitudes.user_id',
            'vageneral.vaempresaxsolicitudes.status',
            'vageneral.vaempresaxsolicitudes.observacion',
            'vageneral.vaempresaxsolicitudes.created',
            'vageneral.vaempresaxsolicitudes.modified',
            'vageneral.vaempresaxsolicitudes.multact',
            'vageneral.vaempresaxsolicitudes.vaestado_id',
            'vageneral.vaempresaxsolicitudes.pdf_signed_user_id',
            'vageneral.vaempresaxsolicitudes.pdf_signed_timestamp',
            'vageneral.vaempresaxsolicitudes.pdf_signed',
            'vageneral.vasolicitudes.id',
            'vageneral.vasolicitudes.status as estatus',
            'vageneral.vaactividades.id',
            'vageneral.vaactividades.nomactv',

        )
            ->from('vageneral.vasolicitudes')
            ->leftjoin('vageneral.vaempresaxsolicitudes', 'vageneral.vasolicitudes.id', '=', 'vageneral.vaempresaxsolicitudes.vasolicitude_id')
            ->leftJoin('public.solicitantes', 'vageneral.vasolicitudes.user_id', '=', 'public.solicitantes.user_id')
            ->join('vageneral.vaactividades', 'vageneral.vasolicitudes.vaactividade_id', '=', 'vageneral.vaactividades.id' )
            ->where('vageneral.vasolicitudes.id', $vasolicitud)
            ->get();

        if ($solicitud->isEmpty()) {
            return view('ttm.error');
        }
        $fechavencimiento = Valibrottm::select(

            'vageneral.valibrodigitales.vasolicitude_id',
            'vageneral.valibrodigitales.folioinea',
            'vageneral.valibrodigitales.numregistro',
            'vageneral.valibrodigitales.fecvencimiento',
            'vageneral.valibrodigitales.fecexpedicion'
        )
            ->from('vageneral.valibrodigitales')
            ->join('vageneral.vasolicitudes', 'vageneral.valibrodigitales.vasolicitude_id', '=', 'vageneral.vasolicitudes.id')
            ->where('vageneral.valibrodigitales.vasolicitude_id', $vasolicitud)
            ->get();


        // recaudos de la solicitud.
        $recaudos = Vainsdocumentales::select(
            'vageneral.vainsdocumentales.id',
            'vageneral.vainsdocumentales.vasolicitude_id',
            'vageneral.vainsdocumentales.varequisito_id',
            'vageneral.varequisitos.nomreq'
        )
            ->from('vageneral.vainsdocumentales')
            ->join('vageneral.varequisitos', 'vageneral.vainsdocumentales.varequisito_id', '=', 'vageneral.varequisitos.id')
            ->where('vageneral.vainsdocumentales.vasolicitude_id', $vasolicitud)
            ->get();

        return view('ttm.solicitud', compact('solicitud', 'recaudos', 'fechavencimiento',));
    }

    public function update(Request $request, $id)
    {
        $solicitud = Vasolicitudttm::findOrFail($id);
        $solicitud->status = $request->input('status');
        //$solicitud->observacion = $request->input('observacion');
        $solicitud->save();

        // Actualizar el estatus en la tabla vasolcicitudes
        Solicitudttm::where('vasolicitude_id', $solicitud->id)
            ->update([
                'status' => $request->input('status'),
                'observacion' => $request->input('observacion')

            ]);

        // Actualizar fecha de vencimiento
        Valibrottm::where('vasolicitude_id', $solicitud->id)
            ->update([
                'fecvencimiento' => $request->input('fecvencimiento')
            ]);

        return redirect()->route('ttm.index')->with('success', 'Solicitud actualizada correctamente.');
    }

    public function destroy($vasolicitude_id)
    {

        // Eliminar los recaudos asociados a $vasolicitud_id
        vainsdocumentales::where('vasolicitude_id', $vasolicitude_id)->delete();

        // Obtener el objeto Vasolicitudttm
        $vasolicitud = Vasolicitudttm::findOrFail($vasolicitude_id);

        // Cambiar el estado a 8
        $vasolicitud->status = 8;
        $vasolicitud->save();

        // Actualizar el estatus en la tabla Solicitudttm
        Solicitudttm::where('vasolicitude_id', $vasolicitud->id)
            ->update([
                'status' => 8,
            ]);
    }

    public function destroyOne($id)
    {
        // Intentar eliminar el recaudo
        vainsdocumentales::where('id', $id)->delete();
    }
}
