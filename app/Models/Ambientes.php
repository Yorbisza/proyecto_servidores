<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ambientes extends Model
{
    use HasFactory;
    protected $connection = 'servidores';

    protected $table = 'servidores.ambientes';

    protected $fillable = [

        'nombre',

    ];
}
