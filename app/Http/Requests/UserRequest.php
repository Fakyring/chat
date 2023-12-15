<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array {
        if (request()->isMethod('post')) {
            return [
                'login' => 'required|string|max:30|min:8',
                'password' => 'required|string|max:20|min:8',
                'name' => 'required|string|max:30|min:6',
                'role' => 'nullable|boolean'
            ];
        } else {
            return [
                'password' => 'string|max:20|min:8',
                'name' => 'string|max:30|min:6',
                'role' => 'nullable|boolean'
            ];
        }
    }
}
