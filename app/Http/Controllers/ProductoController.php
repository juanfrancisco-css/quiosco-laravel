<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoCollection;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //              POSIBLES OPCIONES E FILTRADOS UTILIZANDO ELOQUENT
     //      return new ProductoCollection(Producto::where('disponible',1)->orderBy('id','DESC')->paginate(10));
     //      return new ProductoCollection(Producto::orderBy('id','DESC')->paginate(10));
     //       return new ProductoCollection(Producto::all());
               return new ProductoCollection(Producto::where('disponible',1)->orderBy('id','DESC')->get());
/* 
                     Devolver los productos que solo esten disponibles (true==1) ordenados
                     de forma descendiente 
*/ 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //

       // return $producto;
      //disponible 1 Nodisponible 0
       $producto->disponible = 0;
       $producto->save();

       return[
        'producto' => $producto
       ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
