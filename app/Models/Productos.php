<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Productos extends Model
{
    public function getProductosByCantidad($cantidad_int){
            $productos = 
                DB::table('productos')
                    ->select(
                        'id as producto_id',
                        'codigo as producto_codigo',
                        'nombre as producto_nombre',
                        'petitorio as producto_petitorio',
                        'precio_trama as producto_precio_trama')
                    ->orderByRaw('id ASC')
                    ->take($cantidad_int)
                    ->get();
            return $productos;
    }
    public function getProductosAll(){
        $productos =  
            DB::table('productos')
                ->select(
                    'id as producto_id',
                    'codigo as producto_codigo',
                    'nombre as producto_nombre',
                    'petitorio as producto_petitorio',
                    'precio_trama as producto_precio_trama')
                ->orderByRaw('id ASC')
                ->get();
        return $productos;
    }
}
