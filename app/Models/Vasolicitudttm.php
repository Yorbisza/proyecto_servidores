<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Vasolicitudttm extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'sinea-renave_ttm';
    protected $table = 'vasolicitudes';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'vaactividade_id',
        'user_id',
        'funcionario_id_',
        'funcionario_id',
        'tipsol',
        'fecverdoc',
        'fecevadoc',
        'fecvispre',
        'fecfirmo',
        'fecentrevista',
        'horaentrevista',
        'fecentrega',
        'status',
        'observacion',
        'created',
        'modified',
        'arcqr',
        'fecentrevistacul',
        'numplarec',
        'desvisbuq',
        'solanterior_id',
        'tpsolicitud',
        'planillaadjunta',
        'numdesins',




    ];

    protected $dates = [

        'updated_at'
    ];


}

