<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::group(["prefix" => "v1",], function(){
                
    
    /* Route::group(["prefix" => "session"], function(){
        
        Route::get('', 'AuthController@login');
    }); */

    /* Route::get('token', function(){
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }); */
    
    /* --/PRODUCTOS */
    Route::group(["middleware" => "auth.jwt","prefix" => "productos"],function(){

        // -- /productos?cantidad={int}
        Route::get('',function(Request $request){
            $_cantidad = $request->cantidad;
            if(is_numeric($_cantidad)){
                $productos = DB::table('productos')->take($_cantidad)->get();
                return response()->json([
                    'total_registers' => count($productos),
                    'data' => $productos
                ]);
            }else{
                return response()->json([
                    'message' => "La cantidad '$_cantidad' no es valida."
                ],500);
            }
        });

        // -- /productos/all
        Route::get('all',function(){
            $productos = DB::table('productos')->get();
            return response()->json([
                'data' => $productos,
                'total_registers' => count($productos)
            ]);
        });

    });
    /* PROCEDIMIENTOS */

    /* DIAGNOSTICOS */
});
Route::get('token', 'AuthController@login');