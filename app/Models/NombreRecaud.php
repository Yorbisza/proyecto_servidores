<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class NombreRecaud extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'sinea-renave_ttm';
    protected $table = 'varequisitos';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_antecesor',
        'vatpunidinformativa_id',
        'user_id',
        'nomreq',
        'desreq',
        'status',
        'observacion',
        'created',
        'modified'
    ];

    protected $dates = [

        'updated_at'
    ];

}
