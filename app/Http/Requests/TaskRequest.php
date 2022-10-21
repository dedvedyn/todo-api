<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'description' => 'string|max:255',
            'status' => Rule::in(config('enums.task_statuses')),
            'user_id' => 'required|exists:users,id',
        ];

        switch ($this->getMethod()) {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                        'task_id' => 'required|integer|exists:tasks,id',
                    ] + $rules;
            case 'DELETE':
                return [
                    'task_id' => 'required|integer|exists:tasks,id'
                ];
        }
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'name.min' => 'The name must have at least 5 characters',
            'name.max' => 'The name must not exceed 255 characters',
            'description.max' => 'The description must not exceed 255 characters',
            'user_id.required' => 'The user_id is required',
            'user_id.exists' => 'This user_id doesn\'t exists',
        ];
    }
}