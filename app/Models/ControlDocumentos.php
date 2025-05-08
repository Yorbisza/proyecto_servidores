<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ControlDocumentos extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $connection = 'sinea-renave';
    protected $table = 'ctrl_documentos';
    public $timestamps = false;

    protected $fillable = [
        'solicitud_id',
        'marino_id',
        'nro_doc',
        'nro_ctrl',
        'libro',
        'folio',
        'agenda_cuenta_id',
        'fecha_registro',
        'status',
        'nro_doc_errado',
        'caso_especial',
    ];

    protected $dates = [
        'fecha_emision',
        'fecha_vencimiento',
        'created',
    ];

}
