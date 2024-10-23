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

            'prestaciones.required' => 'El campo data es obligatorio.',
            'prestaciones.array' => 'El campo data debe ser un array.',
            'prestaciones.min' => 'El campo prestaciones no puede estar vacío, debe contener al menos un elemento.',
            'prestaciones.max' => 'El limite maximo de prestaciones a validar es de :max',
        ];
    }

    public function response(array $errors)
    {
        $flattenedErrors = [];
        foreach ($errors as $fieldErrors) {
            $flattenedErrors = array_merge($flattenedErrors, $fieldErrors);
        }
        return new JsonResponse(['errores' => $flattenedErrors], 400);
    }
}
