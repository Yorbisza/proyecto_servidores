<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Solicitud extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'sinea-renave';
    protected $table = 'solicitudes';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nro_solicitud',
        'capitania_id',
        'solicitante_id',
        'documento_id',
        'status',
        'tipo',
        'tipo_emision',
        'tipo_copia',
        'fecha_solicitud',
        'nro_doc',
        'nro_planilla_f16',
        'monto_deposito',
        'timbre_fiscal',
        'forma_16',
        'monto_deposito_fiscal',
        'pergamino',
        'nro_sobre',
        'nro_deposito',
        'firmada',
        'foto_marino',
        'certificado_digital',
        'pdf_signed',
        'pdf_signed_user_id',
        'pdf_signed_timestamp',
        'pdf_signed_sent'
    ];

    protected $casts = [
        'fecha_solicitud',
        'created',
        'modified',
        'fecha_deposito',
        'fecha_deposito_sobre',
        'fecha_firmada_gerente',
        'fecha_firmada_presidente'
    ];
}
