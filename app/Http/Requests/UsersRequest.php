<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
                'users.index', 'users.watch', 'users.audits' => [
                    'search' => 'nullable|string'
                ],
                default => []
            },
            'POST' => [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|confirmed|min:8',
            ],
            'PUT' => [
                'name' => 'required|string|max:255',
                'email' => "required|email|unique:users,email,{$this->id}",
                'password' => 'nullable|confirmed|min:8',
            ]
        };
    }

    /**
     * Prepare for validation before the validation rules
     */
    public function prepareForValidation(): void
    {
        match(request()->method()){
            'GET' => match(request()->route()->getName()){
                'users.index', 'users.watch', 'users.audits' => $this->merge([
                    'search' => $this->search ?? null
                ]),
                default => []
            },
            default => []
        };
    }
}
