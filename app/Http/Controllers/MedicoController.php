<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Medicos;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getMedicosByCantidad(Request $request){
        $_cantidad = $request->cantidad;
        if(is_numeric($_cantidad)){
            $objMedico = new Medicos();
            $query_all_medicos = $objMedico->getMedicosByCantidad($_cantidad);
            return response()->json([
                'total_registros' => count($query_all_medicos),
                'data' => $query_all_medicos
            ],200);
        }else{
            return response()->json([
                'message' => "La cantidad '$_cantidad' no es valida."
            ],400);
        }
    }
    public function getMedicosAll(){
            $objMedico = new Medicos();
            $query_all_medicos = $objMedico->getMedicosAll();
            return response()->json([
                'total_registros' => count($query_all_medicos),
                'data' => $query_all_medicos
            ],200);
    }
}
