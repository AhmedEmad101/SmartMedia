<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatSendRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'receiver_id' => 'required|exists:users,id',
            'message'     => 'nullable|string',
            'attachment'  => 'nullable|string',
        ];
    }
     public function messages(): array
    {
        return [
            'receiver_id.required' => 'The receiver ID is required.',
            'receiver_id.exists'   => 'The specified receiver does not exist.',
            'message.string'       => 'The message must be a string.',
            'attachment.string'    => 'The attachment must be a string.',
        ];
    }
}
