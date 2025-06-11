<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioCategorias extends Model
{
    use HasFactory;
      protected $connection = 'servidores';

    protected $table = 'public.usuarios_categorias';

    protected $fillable = [

        'categoria_id',
        'nombre_usuario',
        'password',


    ];

    public function setSchemaAndTable($connection, $table)
    {
        $this->connection = $connection;
        $this->table = $table;
    }
}
