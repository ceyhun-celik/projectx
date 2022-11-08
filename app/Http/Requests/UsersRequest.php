<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return match(request()->method()){
            'GET' => [
                'search' => 'nullable|string'
            ],
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

    public function prepareForValidation()
    {
        match(request()->method()){
            'GET' => $this->merge([
                'search' => $this->search ?? null
            ]),
            default => []
        };
    }
}
