<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::check()) {
            return false;
        }
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя пользователя не введено',
            'email.required' => 'Email пользователя не введен',
            'password.required' => 'Пароль не введен',
            'name.max' => 'Имя не может быть больше 255 символов',
            'email.max' => 'Email не может быть больше 255 символов',
            'email.email' => 'Неверный формат Email',
            'email.unique' => 'Пользователь с таким Email уже существует',
            'password.min' => 'Пароль не может быть меньше 6 символов',
            'password.confirmed' => 'Пароль не подтвержден',
        ];
    }
}
