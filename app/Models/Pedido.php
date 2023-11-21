<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
        /*
        Un pedido le pertence a un unico usuario
        */
    }

    public function productos()
    {

        return $this->belongsToMany(Producto::class,'pedido_productos')->withPivot('cantidad');
        //esta relacion esta de productos esta en pedido_productos
        // en un pedido puede haber muchos productos

    }
}
