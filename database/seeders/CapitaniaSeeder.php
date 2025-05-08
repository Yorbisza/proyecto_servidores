<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Capitanias;

class capitaniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $capitanias =[
            [
                'nombre'=>'Maracaibo',
                'siglas'=>'AJZL',
            ],
            [
                'nombre'=>'Las Piedras',
                'siglas'=>'AMMT',
            ],
            [
                'nombre'=>'La Guaira',
                'siglas'=>'AGSI',
            ],
            [
                'nombre'=>'Puerto la Cruz',
                'siglas'=>'AGSP',
            ],
            [
                'nombre'=>'Carupano',
                'siglas'=>'ADSS',
            ],
            [
                'nombre'=>'Pampatar',
                'siglas'=>'ARSH',
            ],
            [
                'nombre'=>'Puerto Cabello',
                'siglas'=>'ADKN',
            ],
            [
                'nombre'=>'Puerto Sucre',
                'siglas'=>'APNN',
            ],
            [
                'nombre'=>'Ciudad Bolivar',
                'siglas'=>'ABXI',
            ],
            [
                'nombre'=>'Guiria',
                'siglas'=>'ARSI',
            ],
            [
                'nombre'=>'Ciudad Guayana',
                'siglas'=>'ARSK',
            ],
            [
                'nombre'=>'Apure',
                'siglas'=>'ARSM',
            ],
            [
                'nombre'=>'Amazonas',
                'siglas'=>'ARSL',
            ],
            [
                'nombre'=>'Miranda',
                'siglas'=>'AGSM',
            ],
            [
                'nombre'=>'Sede Central',
                'siglas'=>'SEDE',
            ],
            [
                'nombre'=>'La Vela de Coro',
                'siglas'=>'AQYM',
            ],
            [
                'nombre'=>'La Ceiba',
                'siglas'=>'ACGL',
            ],
            [
                'nombre'=>'Delta Amacuro',
                'siglas'=>'ADAR',
            ],
            [
                'nombre'=>'Caripito',
                'siglas'=>'ARSJ',
            ],


        ];


        foreach($capitanias as $cap){
            Capitanias::create($cap);
        }

    }
}
