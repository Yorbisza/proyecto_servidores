<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorias;


class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $categoria =[
            [
                'nombre'=> 'Servidores',
            ],
            [
                'nombre' => 'Base de Datos',
            ],
        ];
        foreach($categoria as $c){
            Categorias::create($c);
        }
    }
}
