<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleCompra extends Model
{
    use HasFactory;

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }
    /*     public function proveedor()
    {
        return $this->belongsTo(Proveedor::class,'proveedores_id');
    }    */
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
