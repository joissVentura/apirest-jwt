<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Procedimientos;

class ProcedimientoController extends Controller
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
    public function getProcedimientosByCantidad(Request $request){
        
        $_cantidad = $request->cantidad;
        if(is_numeric($_cantidad)){
            $objProcedimientos = new Procedimientos();
            $query_procedimientos = $objProcedimientos->getProcedimientosByCantidad($_cantidad);
            return response()->json([
                'total_registros' => count($query_procedimientos),
                'data' => $query_procedimientos
            ],200);
        }else{
            return response()->json([
                'message' => "La cantidad '$_cantidad' no es valida."
            ],400);
        }
    }
    public function getProcedimientosAll(){
        $objProcedimientos = new Procedimientos();
        $query_all_procedimientos = $objProcedimientos->getProcedimientosAll();
        return response()->json([
            'total_registros' => count($query_all_procedimientos),
            'data' => $query_all_procedimientos
        ],200);
    }
}
