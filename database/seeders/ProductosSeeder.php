<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'titulo'=> 'QG5',
            'descripcion' => 'Medicamento para la colitis',
            'precioU'=> 45.25,
            'precioV'=> 79.90,
            'cantidadP'=> 100
        ]);
        Producto::create([
            'titulo'=> 'Febrax',
            'descripcion' => 'Medicamento para el dolor',
            'precioU'=> 69.54,
            'precioV'=> 243.87,
            'cantidadP'=> 320
        ]);
    }
}