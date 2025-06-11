<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servidores extends Model
{
    use HasFactory;
    protected $connection = 'servidores';

    protected $table = 'servidores.servidores';

    protected $fillable = [

        'nombre_servidores',
        'ip_servidores',
        'puerto',
        'ambiente_id',
        'capitania_id',
        'user_categoria_id'
    ];
}
