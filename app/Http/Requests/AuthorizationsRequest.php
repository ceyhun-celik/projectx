<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizationsRequest extends FormRequest
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
        return match(request()->method()){
            'GET' => match(request()->route()->getName()){
                'authorizations.index', 'authorizations.audits' => [
                    'search' => 'nullable|string'
                ],
                default => []
            },
            'POST' => [
                'user_id' => 'required|integer',
                'role_code' => 'required|string|in:root,visitor'
            ],
            'PUT' => [
                'role_code' => 'required|string|in:root,visitor',
                'status' => 'required|string|in:active,banned'
            ],
            default => []
        };
    }

    /**
     * Prepare for validation before the validation rules
     */
    public function prepareForValidation(): void
    {
        match(request()->method()){
            'GET' => match(request()->route()->getName()){
                'authorizations.index', 'authorizations.audits' => $this->merge([
                    'search' => $this->search ?? null
                ]),
                default => []
            },
            default => []
        };
    }
}
