<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
                'id_user' => 'nullable|exists:users,id_user|int',
                'id_convers' => 'exists:convers,id_convers|required|int',
                'text' => 'required|string|max:10000',
                'deleted' => 'nullable|boolean'
            ];
        } else {
            return [
                'id_user' => 'nullable|int',
                'id_convers' => 'int',
                'text' => 'string|max:10000',
                'deleted' => 'nullable|boolean'
            ];
        }
    }
}
