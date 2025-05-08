<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class vainsdocumentales extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'sinea-renave_ttm';
    protected $table = 'vainsdocumentales';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'vasolicitude_id',
        'varequisito_id',
        'user_id',
        'chkrequisito',
        'observacionchk',
        'rutcararchivo',
        'fecenvreq',
        'funcionario_id',
        'status',
        'observacion',
        'created',
        'modified'


    ];

    protected $dates = [
        'fecrevreq',
        'fecreccap',
        'fecdocfis',
        'fecevareq',
        'updated_at'
    ];


}

