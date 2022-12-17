<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string'],
            'mobile'    => ['required', 'regex:/(09)[0-9]{9}/', 'numeric', 'digits:11', Rule::unique('users')],
            'password' => ['required', 'string', Rules\Password::defaults()],
            'role'     => ['required', 'integer', 'exists:roles,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}