<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Controllers\ProductoController;

class EditarController extends Controller
{
    public function index()
    {
        $productos = Producto::All();
        return view('farmaciascuquita.productoEdit', compact('productos'));
    }
}