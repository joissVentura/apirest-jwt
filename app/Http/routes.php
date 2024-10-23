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
                
    /* Route::group(["prefix"=>"create"], function(){
        Route::post('user', 'AuthController@create');
    }); */

    /*          /v1/token       */
    /* Route::group(["prefix"=>"token"], function(){
        // ---  /v1/token/generate
        Route::get('generate', 'AuthController@login');
    }); */


    /* --      /v1/productos        */
    Route::group([/* "middleware" => "auth.jwt", */"prefix" => "productos"],function(){

        // --   /v1/productos?cantidad={int}
        Route::get('', 'ProductoController@getProductosByCantidad');

        // --   /v1/productos/all
        Route::get('all','ProductoController@getProductosAll');

    });

    /* --       /v1/procedimientos      */
    Route::group([/* "middleware" => "auth.jwt", */"prefix" => "procedimientos"],function(){

        // --   /v1/procedimientos?cantidad={int}
        Route::get('','ProcedimientoController@getProcedimientosByCantidad');

        // -- /v1/procedimientos/all
        Route::get('all','ProcedimientoController@getProcedimientosAll');

    });

    /* --       /v1/diagnosticos      */
    Route::group([/* "middleware" => "auth.jwt", */"prefix" => "diagnosticos"],function(){

        // -- /v1/diagnosticos?cantidad={int}
        Route::get('','DiagnosticoController@getDiagnosticosByCantidad');

        // -- /v1/diagnosticos/all
        Route::get('all','DiagnosticoController@getDiagnosticosAll');

    });

    /* --       /v1/medicos      */
    Route::group([/* "middleware" => "auth.jwt", */"prefix" => "medicos"],function(){

        // -- /v1/medicos?cantidad={int}
        Route::get('','MedicoController@getMedicosByCantidad');

        // -- /v1/medicos/all
        Route::get('all','MedicoController@getMedicosAll');

    });
    /* Route::group(["prefix" => "was"],function(){


        Route::get('',function(){
            return response()->stream(function () {

                $i = 0;
                
                while (true) {

                    $i++;
                    $productos = 
                DB::table('productos')
                    ->select(
                        'id as producto_id',
                        'codigo as producto_codigo',
                        'nombre as producto_nombre',
                        'petitorio as producto_petitorio',
                        'precio_trama as producto_precio_trama')
                    ->orderByRaw('id ASC')
                    ->take($i)
                    ->get();

                    echo "data:" . json_encode([
                        'total_registros' => count($productos),
                        'data' => $productos
                    ]) . "\n\n";   // Datos enviados
                    ob_flush();
                    flush();
                    sleep(5);  // Enviar cada 5 segundos
                }
            }, 200, [
                
                'Content-Type' => 'text/event-stream',
                'Cache-Control' => 'no-cache',
                'Connection' => 'keep-alive',
            ]);
        });

    }); */
});


Route::group(["prefix" => "/api/v1",], function(){
    Route::group(["prefix" => "simular-interoperabilidad/masivo"],function(){
        Route::post('', 'SimulateInteroperabilityController@massive');
    });
});
