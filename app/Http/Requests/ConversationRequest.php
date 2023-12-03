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
        if (request()->method('post')) {
            return [
                'id_creator' => 'nullable|int',
                'name' => 'required|string|max:50',
                'private' => 'nullable|boolean',
                'description' => 'nullable|string|max:255'
            ];
        } else {
            return [
                'id_creator' => 'nullable|int',
                'name' => 'string|max:50',
                'private' => 'nullable|boolean',
                'description' => 'nullable|string|max:255'
            ];
        }
    }
}
