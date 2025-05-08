<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Valibrottm extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'sinea-renave_ttm';
    protected $table = 'valibrodigitales';
    public $timestamps = false;

    protected $fillable = [

        'vasolicitude_id',
        'folioinea',
        'numregistro',

    ];

    protected $dates = [

        'fecvencimiento',
        'fecexpedicion',
        'updated_at'
    ];



}
