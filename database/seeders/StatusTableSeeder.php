<?php

namespace Database\Seeders;

use App\Models\status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $status =[
            [
                'nombre'=> 'Activo',
                'descripcion' => 'Habilitado',
            ],
            [
                'nombre' => 'Inactivo',
                'descripcion' => 'Deshabilitado',
            ],
        ];
        foreach($status as $s){
            status::create($s);
        }
    }
}
