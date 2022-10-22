<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:32',
            'role' => Rule::in(config('enums.user_roles')),
        ];

        switch ($this->getMethod()) {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'user_id' => 'required|integer|exists:users,id',
                    'name' => 'string|min:5|max:255',
                    'email' => 'email',
                    'password' => 'string|min:8|max:32',
                    'role' => Rule::in(config('enums.user_roles')),
                ];
            case 'DELETE':
                return [
                    'user_id' => 'required|integer|exists:users,id'
                ];
        }
    }
}
