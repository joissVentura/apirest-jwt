<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Medicos extends Model
{
    public function getMedicosByCantidad($cantidad_int){
        $medicos = 
            DB::table('medicos as m')
            ->join('tipo_documento_identidad as tdi', 'm.tipo_documento', '=', 'tdi.id')
            ->leftJoin('especializaciones as e', 'm.id_especializacion', '=', 'e.id')
            ->leftJoin('colegio_profesionales as cp', 'm.id_colegio_profesional', '=', 'cp.id')
            ->leftJoin('establecimientos as e2', 'm.id_establecimiento', '=', 'e2.id')
            ->select(
                'tdi.descripcion as medico_tipo_doc',
                'm.dni as medico_nro_doc',
                DB::raw('CASE WHEN m.id_colegio_profesional = 1 THEN NULL ELSE m.colegiatura END as medico_nro_colegiatura'),
                'm.nombre as medico_nombre',
                'm.paterno as medico_apellido_paterno',
                'm.materno as medico_apellido_materno',
                DB::raw('CASE WHEN m.id_colegio_profesional = 1 THEN NULL ELSE e.nombre END as medico_especialidad'),
                'cp.descripcion as medico_colegio',
                'e2.nombre as medico_establecimiento'
            )
            ->where('m.estado', 1)
            ->whereNotIn('m.id_profesion', [24, 25, 28, 29, 34, 36, 38, 40, 48])
            ->take($cantidad_int)
            ->get();
        return $medicos;
    }
public function getMedicosAll(){
    $medicos =  
        DB::table('medicos as m')
            ->join('tipo_documento_identidad as tdi', 'm.tipo_documento', '=', 'tdi.id')
            ->leftJoin('especializaciones as e', 'm.id_especializacion', '=', 'e.id')
            ->leftJoin('colegio_profesionales as cp', 'm.id_colegio_profesional', '=', 'cp.id')
            ->leftJoin('establecimientos as e2', 'm.id_establecimiento', '=', 'e2.id')
            ->select(
                'tdi.descripcion as tipo_doc',
                'm.dni as nro_doc',
                DB::raw('CASE WHEN m.id_colegio_profesional = 1 THEN NULL ELSE m.colegiatura END as nro_colegiatura'),
                'm.nombre as nombre_medico',
                'm.paterno as paterno_medico',
                'm.materno as materno_medico',
                DB::raw('CASE WHEN m.id_colegio_profesional = 1 THEN NULL ELSE e.nombre END as especialidad_medico'),
                'cp.descripcion as colegio',
                'e2.nombre as establecimiento'
            )
            ->where('m.estado', 1)
            ->whereNotIn('m.id_profesion', [24, 25, 28, 29, 34, 36, 38, 40, 48])
            ->get();
        return $medicos;
    }
}

