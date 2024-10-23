<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\SimulateInteroperabilityRequest;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class SimulateInteroperabilityController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massive(SimulateInteroperabilityRequest $request)
    {
        if ($request->acceso["usuario"] !== "wAiP5uG9s@cci.wa.sp" || $request->acceso["clave"] !== "7P^Q6s*m6S@e5P-") {
            return response()->json([
                "message" => "credenciales incorrectas",
            ], Response::HTTP_UNAUTHORIZED);
        }

        $rowsSuccess = [];
        $rowsErrors = [];
        $rowsErrors = [];

        $arraysErrors = [
            [
                "code" => "RCI01",
                "message" => "La afiliación del paciente no se encuentra vigente."
            ],
            [
                "code" => "RCI02",
                "message" => "El código siteds enviado en la prestación no existe."
            ],
            [
                "code" => "RCI03",
                "message" => "Los datos del paciente ingresados son incorrectos o no coinciden con el registro del fondo de seguro."
            ],
            [
                "code" => "RCI04",
                "message" => "Se ha intentado validar o facturar dos veces la misma prestación de salud."
            ],
            [
                "code" => "RCI05",
                "message" => "El diagnóstico ingresado no es compatible con la prestación de salud solicitada."
            ],
            [
                "code" => "RCI06",
                "message" => "Inconsistencias en el historial médico del paciente afectan la validez de la prestación solicitada."
            ],
            [
                "code" => "RCI07",
                "message" => "Las políticas del fondo de seguro han cambiado recientemente, afectando la validez de la prestación solicitada."
            ]
        ];        

        foreach ($request->prestaciones as $key => $prestacion) {

            if (rand(0, 3) !== 0 || $request->prestaciones < 3) {
                array_push($rowsSuccess, [ 
                    "v_cups_pnp" => $prestacion["prestacion"]["v_cups_pnp"],
                    "codigo" => "0000",
                    "mensaje" => "La prestación es válida y está pendiente de liquidación",
                ]);
            } else {
                $error = $arraysErrors[array_rand($arraysErrors)];
                array_push($rowsErrors, [ 
                    "v_cups_pnp" => $prestacion["prestacion"]["v_cups_pnp"],
                    "codigo" => $error['code'],
                    "mensaje" => $error['message'],
                ]);
            }
        }

        return response()->json([
            "message" => "el proceso de validacion masiva se ejecuto exitosamente",
            "timestamp" => Carbon::now()->toDateTimeString(),
            "data" => [
                "cantidad_prestaciones_recibidas" => count($request->prestaciones),
                "cantidad_prestaciones_procesadas" => count($rowsSuccess) + count($rowsErrors),
                "cantidad_prestaciones_validas" => count($rowsSuccess),
                "cantidad_prestaciones_erroneas" => count($rowsErrors),
                "prestaciones_validas" => $rowsSuccess,
                "prestaciones_erroneas" => $rowsErrors,
            ],
            "detalles" => [
                "entorno" => "production"
            ]
        ], Response::HTTP_OK);
    }
}
