<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PruebaSucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Sucursal::factory(10)->create();
    }
}
