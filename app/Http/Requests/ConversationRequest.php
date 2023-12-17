<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConversationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'id_creator' => 'nullable|exists:users,id_user|int',
                'name' => 'required|string|max:50',
                'description' => 'nullable|string|max:255',
                'private' => 'nullable|int'
            ];
        } else {
            return [
                'id_creator' => 'nullable|exists:users,id_user|int',
                'name' => 'string|max:50',
                'description' => 'string|max:255',
                'private' => 'nullable|int'
            ];
        }
    }
}
