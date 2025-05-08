<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $permisos = [
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operaciones sobre tabla soliciudes del sinea
            'ver-solicitud',
            'crear-solicitud',
            'editar-solicitud',
            'borrar-solicitud',

             //Operaciones sobre menu usuarios
             'ver-usuario',
             'crear-usuario',
             'editar-usuario',
             'borrar-usuario',

             //Operaciones en Dashboard
             'ver-dashboard',

             //Operaciones sobre el modulo de auditoria
             'ver-auditoria',

            //Operaciones sobre tabla soliciudes ttm
            'ver-ttm',
            'crear-ttm',
            'editar-ttm',
            'borrar-ttm',
            'borrar-all',

            //Operaciones sobre tabla Servidores
            'ver-servidores',
            'crear-servidores',
            'editar-servidores',
            'borrar-servidores',
        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
