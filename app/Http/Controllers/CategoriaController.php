<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //

    public function index(){
        //dd('desde categoria controller');

        //return response()->json(['categorias' => Categoria::all()]);
//                              DEVOLVER TODAS LAS CATEGORIAS
        return new CategoriaCollection(Categoria::all());
    }
}
