<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        // Mengambil objek / ID user dari parameter route ({user})
        $userId = $this->route('user') ? ($this->route('user')->id ?? $this->route('user')) : null;

        return [
            'name' => 'required|string|max:100',

            'email' => [
                'required',
                'email',
                // Mengabaikan ID user saat ini agar email-nya sendiri tidak dianggap duplikat
                Rule::unique('users', 'email')->ignore($userId),
            ],

            'password'  => 'nullable|min:8',
            'role_id'   => 'required',
            'is_active' => 'nullable|boolean'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'    => 'Nama wajib diisi.',
            'name.max'         => 'Maksimal panjang nama 100 karakter.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'email.unique'     => 'Email ini sudah digunakan oleh user lain.',
            'password.min'     => 'Password minimal 8 karakter.',
            'role_id.required' => 'Role wajib diisi.'
        ];
    }
}