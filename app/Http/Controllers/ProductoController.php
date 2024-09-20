<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Productos;

class ProductoController extends Controller
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
    public function getProductosByCantidad(Request $request){
        $_cantidad = $request->cantidad;
        if(is_numeric($_cantidad)){
            $objProducto = new Productos();
            $query_productos = $objProducto->getProductosByCantidad($_cantidad);
            return response()->json([
                'total_registros' => count($query_productos),
                'data' => $query_productos
            ],200);
        }else{
            return response()->json([
                'message' => "La cantidad '$_cantidad' no es valida."
            ],400);
        }
    }
    public function getProductosAll(){
            $objProducto = new Productos();
            $query_all_productos = $objProducto->getProductosAll();
            return response()->json([
                'total_registros' => count($query_all_productos),
                'data' => $query_all_productos
            ],200);
    }
}
