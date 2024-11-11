<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HabitacioneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'identificador' => ['required', 'string', 'max:5', 'min:1'],
            'piso' => ['required', 'integer', 'max_digits:3', 'min_digits:1'],
            'tipo' => ['required', 'string', 'max:13', 'min:1'],
            'numPersonas' => ['required', 'integer', 'min_digits:1', 'max_digits:3'],
            'precio' => ['required'],
            'sede_id' => ['required']
        ];
    }
}
