<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Procedimientos extends Model
{
    public function getProcedimientosByCantidad($cantidad_int){
        
        $query_procedimientos = 
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
                    ->take($cantidad_int)
                    ->get();
        return $query_procedimientos;
    }
    public function getProcedimientosAll(){
        
        $query_procedimientos = 
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
        return $query_procedimientos;
    }
}