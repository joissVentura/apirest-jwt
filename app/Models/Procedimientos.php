<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Procedimientos extends Model
{
    public function getProcedimientosCantidad($cantidad){
        
        if(is_numeric($cantidad)){
            $procedimientos = 
                DB::table('procedimientos')
                    ->select(
                        'id as procedimiento_id',
                        'codigo as procedimiento_codigo',
                        'descripcion as procedimiento_descripcion',
                        't_nivel3 as procedimiento_t_nivel3',
                        't_nivel2 as procedimiento_t_nivel2',
                        't_nivel1 as procedimiento_t_nivel1'
                        )
                    ->orderByRaw('id ASC')
                    ->take($cantidad)
                    ->get();
            return response()->json([
                'total_registros' => count($procedimientos),
                'data' => $procedimientos
            ],200);
        }else{
            return response()->json([
                'message' => "La cantidad '$cantidad' no es valida."
            ],400);
        }
    }
    public function getProcedimientosAll(){
        
        $procedimientos = 
            DB::table('procedimientos')
                ->select(
                    'id as procedimiento_id',
                    'codigo as procedimiento_codigo',
                    'descripcion as procedimiento_descripcion',
                    't_nivel3 as procedimiento_t_nivel3',
                    't_nivel2 as procedimiento_t_nivel2',
                    't_nivel1 as procedimiento_t_nivel1'
                    )
                ->orderByRaw('id ASC')
                ->get();
        return response()->json([
            'total_registros' => count($procedimientos),
            'data' => $procedimientos
        ],200);
    }
}