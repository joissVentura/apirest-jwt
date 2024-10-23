<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Http\JsonResponse;

class SimulateInteroperabilityRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'acceso.usuario' => 'required',
            'acceso.clave' => 'required',
            'prestaciones' => 'required|array|min:1|max:100'
        ];
    }

    public function messages()
    {
        return [
            'acceso.usuario.required' => 'El campo usuario es obligatorio.',
            'acceso.clave.required' => 'El campo clave es obligatorio.',

            'prestaciones.required' => 'El campo prestaciones es obligatorio.',
            'prestaciones.array' => 'El campo prestaciones debe ser un array.',
            'prestaciones.min' => 'El campo prestaciones no puede estar vacío, debe contener al menos un elemento.',
            'prestaciones.max' => 'El limite maximo de prestaciones a validar es de :max',
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse(['errores_validacion' => $errors], 400);
    }
}
