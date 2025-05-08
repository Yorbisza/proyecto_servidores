<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Solicitudttm extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'sinea-renave_ttm';
    protected $table = 'vaempresaxsolicitudes';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'vasolicitude_id',
        'vaempresa_id',
        'vaactividade_id',
        'user_id',
        'status',
        'observacion',
        'created',
        'modified',
        'multact',
        'vaestado_id',
        'pdf_signed_user_id',
        'pdf_signed_timestamp',
        'pdf_signed',
        'vasolicitudes.id',
        'vasolicitudes.status'


    ];

    protected $dates = [
        /* 'fecha_solicitud',
        'created',
        'modified',
        'fecha_deposito',
        'fecha_deposito_sobre',
        'fecha_firmada_gerente',
        'fecha_firmada_presidente', */
        'updated_at'
    ];

    
}

