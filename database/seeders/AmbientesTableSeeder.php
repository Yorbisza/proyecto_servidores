<?php

namespace Database\Seeders;

use App\Models\Ambientes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmbientesTableSeeder extends Seeder
{
    public function run()
    {
        $ambiente =[
            [
                'nombre'=> 'Producción',
            ],
            [
                'nombre' => 'Calidad',
            ],
            [
                'nombre' => 'Desarrollo',
            ],
        ];
        foreach($ambiente as $a){
            ambientes::create($a);
        }
    }
}
