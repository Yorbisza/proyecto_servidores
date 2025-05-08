<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Vaactividadttm extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'sinea-renave_ttm';
    protected $table = 'valibrodigitales';
    public $timestamps = false;

    protected $fillable = [

            'id',
            'vatpdocumento_id',
            'user_id',
            'codformulario',
            'nomactv',
            'disformulario',
            'desact',
            'nota',
            'status',
            'observacion',
            'created',
            'modified',
            'valineamiento_id',
            'action_print',
            'stamper_position',
            'stamper_size',
            'stamper_page',
            'qr_position',
            'qr_size',
            'qr_page',


    ];

    protected $dates = [


    ];



}
