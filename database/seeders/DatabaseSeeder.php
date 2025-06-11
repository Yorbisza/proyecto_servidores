<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CapitaniaSeeder::class,
            PermisoSeeder::class,
            StatusTableSeeder::class,
            AmbientesTableSeeder::class,
            CategoriaTableSeeder::class
        ]);
    }
}
