<?php

use App\Models\Productos;
use App\Models\Procedimientos;
use App\Models\Diagnosticos;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::group(["prefix" => "v1",], function(){
                
    Route::group(["prefix"=>"create"], function(){
        Route::post('user', 'AuthController@create');
    });

    /* GENERAR TOKEN */
    Route::group(["prefix"=>"token"], function(){
        Route::get('generate', 'AuthController@login');
    });


    /* --/productos */
    Route::group(["middleware" => "auth.jwt","prefix" => "productos"],function(){

        // -- /productos?cantidad={int}
        Route::get('',function(Request $request){
            $_cantidad = $request->cantidad;
            $objProducto = new Productos();
            return $objProducto->getProductosCantidad($_cantidad);
        });

        // -- /productos/all
        Route::get('all',function(){
            $objProducto = new Productos();
            return $objProducto->getProductosAll();
        });

    });

    /* --/procedimientos */
    Route::group(["middleware" => "auth.jwt","prefix" => "procedimientos"],function(){

        // -- /procedimientos?cantidad={int}
        Route::get('',function(Request $request){
            $_cantidad = $request->cantidad;
            $objProcedimientos = new Procedimientos();
            return $objProcedimientos->getProcedimientosCantidad($_cantidad);
        });

        // -- /procedimientos/all
        Route::get('all',function(){
            $objProcedimientos = new Procedimientos();
            return $objProcedimientos->getProcedimientosAll();
        });

    });

    /* DIAGNOSTICOS */
    Route::group(["middleware" => "auth.jwt","prefix" => "diagnosticos"],function(){

        // -- /diagnosticos?cantidad={int}
        Route::get('',function(Request $request){
            $_cantidad = $request->cantidad;
            $objProcedimientos = new Diagnosticos();
            return $objProcedimientos->getDiagnosticosCantidad($_cantidad);
        });

        // -- /diagnosticos/all
        Route::get('all',function(){
            $objProcedimientos = new Diagnosticos();
            return $objProcedimientos->getDiagnosticosAll();
        });

    });

});
