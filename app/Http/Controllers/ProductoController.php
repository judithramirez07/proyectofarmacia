<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Sucursal;
use Illuminate\Http\Request;

/**CRUD
     * Listado -> Index --LISTO
     * Form Creación -> create --LISTO
     * Guardar a DB -> store --LISTO
     * Ver Detalle -> show --LISTO
     * Form Editar -> edit --LISTO
     * Guardar Cambios a la DB -> update --LISTO
     * Eliminar -> delete --LISTO
     */ 

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::get();
        return view('farmaciascuquita.productoIndex', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('farmaciascuquita.productoForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Producto  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>'required',
            'descripcion'=>'required',
            'precioU'=>'required',
            'precioV'=>'required',
            'cantidadP'=>'required'
        ]);

        $productos = Producto::create($request->all());

        return redirect()->route('producto.show', $productos)->with('mensajeAlert4', '*Agregado Exitosamente*');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sucursales = Sucursal::get();
        $productos = Producto::find($id);
        return view ('farmaciascuquita.productoShow', compact('productos','sucursales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view ('farmaciascuquita.productoForm', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'titulo'=>'required | max:50',
            'descripcion'=>'required | min:10',
            'precioU'=>'required | max:10',
            'precioV'=>'required | max:10',
            'cantidadP'=>'required | max:10'
        ]);

        Producto::where('id', $producto->id)->update($request->except('_token','_method'));

        return redirect()->route('producto.show', $producto)->with('mensajeAlert3', '*Actualizado Exitosamente*');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('producto.index')->with('mensajeAlert', '*Eliminado Exitosamente*');
    }

    /**
     * AGERGA UNA SUCURSAL A UN PRODUCTO
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function agregaSucursal(Request  $request,Producto $producto)
    {
       $producto->sucursales()->sync($request->sucursal_id);

       return redirect()->route('producto.show',$producto)->with('mensajeAlert2', '*Agregado Exitosamente*');
    }
}
