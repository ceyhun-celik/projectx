<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuditsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable|string'
        ];
    }

    /**
     * Prepare for validation before the validation rules
     */
    public function prepareForValidation(): void
    {
        match(request()->method()){
            'GET' => $this->merge([
                'search' => $this->search ?? null
            ]),
            default => []
        };
    }
}
