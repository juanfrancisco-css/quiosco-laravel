<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoCollection;
use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\PedidoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //


        //return 'Correcto....';

       // return new PedidoCollection(Pedido::where('estado',0)->get());
       return new PedidoCollection(Pedido::with('user')->with('productos')->where('estado',0)->get());
       //cargar el method user con with asi podemos acceder a esa relacion
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //almacenar
        $pedido = new Pedido;
        $pedido->user_id = Auth::user()->id;
        $pedido->total = $request->total;
        $pedido->save();

        //Obtener id del pedido
           $id = $pedido->id;

        //Obtener los productos 
          $productos = $request->productos;

        //Formatear un arreglo 
        $pedido_producto =[];
        foreach ( $productos as  $producto) {
            $pedido_producto[]=[
                'pedido_id'   => $id,
                'producto_id' => $producto['id'],
                'cantidad'    => $producto['cantidad'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
            ];
        }


        //Almacenar en la BBDD
        PedidoProducto::insert( $pedido_producto);

        return [
            //'message' => 'Realizando pedido ' . $pedido->id,
          //  'productos' => $request->productos,
          'message' => 'Pedido realizado correctamente , estara listo en unos minutos '
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
//el pedido el cual estamos confirmando
$pedido->estado =1;
$pedido->save();
       // return $pedido;

       return [
        'pedido' => $pedido
       ];


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
