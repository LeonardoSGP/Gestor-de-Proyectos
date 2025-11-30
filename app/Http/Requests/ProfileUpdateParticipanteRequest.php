<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateParticipanteRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            // Campos extra del participante
            'telefono' => ['nullable', 'string', 'max:20'],
            'no_control' => ['required', 'string', 'max:20', Rule::unique('participantes', 'no_control')->ignore($this->user()->participante->id ?? null)],
            'carrera_id' => ['required', 'exists:carreras,id'],
        ];
    }
}
