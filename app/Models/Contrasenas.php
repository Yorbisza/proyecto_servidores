<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contrasenas extends Model
{
    use HasFactory;
    protected $connection = 'servidores';

    protected $table = 'servidores.contrasenas';

    protected $fillable = [

        'serve_id',
        'nombre_usuario',
        'password',


    ];

    public function setSchemaAndTable($connection, $table)
    {
        $this->connection = $connection;
        $this->table = $table;
    }
}
