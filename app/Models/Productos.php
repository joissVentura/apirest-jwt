<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Productos extends Model
{
    public function getProductosCantidad($cantidad){
        if(is_numeric($cantidad)){
            $productos = 
                DB::table('productos')
                    ->select(
                        'id as producto_id',
                        'codigo as producto_codigo',
                        'nombre as producto_nombre',
                        'petitorio as producto_petitorio',
                        'precio_trama as producto_precio_trama')
                    ->orderByRaw('id ASC')
                    ->take($cantidad)
                    ->get();
            return response()->json([
                'total_registros' => count($productos),
                'data' => $productos
            ],200);
        }else{
            return response()->json([
                'message' => "La cantidad '$cantidad' no es valida."
            ],400);
        }
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
        return response()->json([
            'total_registros' => count($productos),
            'data' => $productos
        ],200);
    }
}
