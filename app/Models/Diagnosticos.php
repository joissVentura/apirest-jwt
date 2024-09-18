<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Diagnosticos extends Model
{
    public function getDiagnosticosCantidad($cantidad){
        if(is_numeric($cantidad)){
            $productos = 
                DB::table('diagnosticos')
                    ->select(
                        'id as diagnostico_id',
                        'nombre as diagnostico_nombre',
                        'genero as diagnostico_genero',
                        'estado as diagnostico_estado')
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
    public function getDiagnosticosAll(){
        $productos =  
            DB::table('diagnosticos')
                ->select(
                    'id as diagnostico_id',
                    'nombre as diagnostico_nombre',
                    'genero as diagnostico_genero',
                    'estado as diagnostico_estado')
                ->orderByRaw('id ASC')
                ->get();
        return response()->json([
            'total_registros' => count($productos),
            'data' => $productos
        ],200);
    }
}
