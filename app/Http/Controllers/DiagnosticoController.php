<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Diagnosticos;

class DiagnosticoController extends Controller
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

    public function getDiagnosticosByCantidad(Request $request){
        $_cantidad = $request->cantidad;

        if(is_numeric($_cantidad)){
            $_cantidad = $request->cantidad;
            $objDiagnosticos = new Diagnosticos();
            $query_diagnosticos = $objDiagnosticos->getDiagnosticosByCantidad($_cantidad);

            return response()->json([
                'total_registros' => count($query_diagnosticos),
                'data' => $query_diagnosticos
            ],200);
        }else{
            return response()->json([
                'message' => "La cantidad '$_cantidad' no es valida."
            ],400);
        }
    }
    public function getDiagnosticosAll(){
        $objDiagnosticos = new Diagnosticos();
        $query_diagnosticos = $objDiagnosticos->getDiagnosticosAll();

        return response()->json([
            'total_registros' => count($query_diagnosticos),
            'data' => $query_diagnosticos
        ],200);
    }
}
