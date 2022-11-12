<?php

namespace App\Http\Requests;

use App\Enums\Authorizations\Languages;
use App\Enums\Authorizations\Statuses;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
        # get role codes if request method is POST or PUT
        if(in_array(request()->method(), ['POST', 'PUT'])){
            $role_codes = implode(',', Role::pluck('role_code')->toArray());
        }
        
        return match(request()->method()){
            'GET' => match(request()->route()->getName()){
                'authorizations.index', 'authorizations.audits' => [
                    'search' => 'nullable|string'
                ],
                default => []
            },
            'POST' => [
                'user_id' => 'required|integer',
                'role_code' => "required|string|in:{$role_codes}",
                'language' => [new Enum(Languages::class)]
            ],
            'PUT' => [
                'role_code' => "required|string|in:{$role_codes}",
                'status' => [new Enum(Statuses::class)],
                'language' => [new Enum(Languages::class)]
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
