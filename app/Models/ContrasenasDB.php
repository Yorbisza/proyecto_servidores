<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContrasenasDB extends Model
{
    use HasFactory;
    protected $connection = 'servidores';

    protected $table = 'database.contrasenas';

    protected $fillable = [

        'db_id',
        'nombre_usuario',
        'password',


    ];
}
