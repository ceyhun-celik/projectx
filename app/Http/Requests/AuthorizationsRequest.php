<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizationsRequest extends FormRequest
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
                'user_id' => 'required|integer',
                'role_id' => 'required|integer'
            ],
            'PUT' => [
                //
            ],
            default => []
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
