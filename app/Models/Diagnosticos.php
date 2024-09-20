<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Diagnosticos extends Model
{
    public function getDiagnosticosByCantidad($cantidad){
        $query_diagnosticos = 
            DB::table('diagnosticos')
                ->select(
                    'id as diagnostico_id',
                    'nombre as diagnostico_nombre',
                    DB::raw(
                        "CASE
                            WHEN genero = 1 THEN 'HOMBRE'
                            WHEN genero = 2 THEN 'MUJER'
                            WHEN genero = 3 THEN 'AMBOS'
                        END as diagnostico_genero"
                    ))
                ->orderByRaw('id ASC')
                ->where('estado',1)
                ->take($cantidad)
                ->get();
        return $query_diagnosticos;
    }
    public function getDiagnosticosAll(){
        $query_diagnosticos = 
            DB::table('diagnosticos')
                ->select(
                    'id as diagnostico_id',
                    'nombre as diagnostico_nombre',
                    DB::raw(
                        "CASE
                            WHEN genero = 1 THEN 'HOMBRE'
                            WHEN genero = 2 THEN 'MUJER'
                            WHEN genero = 3 THEN 'AMBOS'
                        END as diagnostico_genero"
                    ))
                ->orderByRaw('id ASC')
                ->where('estado',1)
                ->get();
        return $query_diagnosticos;
    }
}
