<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ambientes;

class BaseDatos extends Model
{
    use HasFactory;

     protected $connection = 'servidores';

    protected $table = 'database.base_datos';

    protected $fillable = [

        'nombre_servidor',
        'nombre_database',
        'ip_database',
        'puerto',
        'ambiente_id',
    ];

    public function ambiente()
    {
        return $this->belongsTo(Ambientes::class, 'ambiente_id');
    }
}
