<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[а-яА-Я\s]+$/u',
            'email' => 'required|email',
            'login' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'image' => 'image|mimes:jpg',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле не должно быть пустым',
            'name.regex' => 'Поле должно содержать только кириллицу',
            'email.required' => 'Поле не должно быть пустым',
            'email.email' => 'Данные должны быть в формате "E-mail". Например: "user@mail.ru".',
            'login.required' => 'Поле не должно быть пустым',
            'login.unique' => 'Такой пользователь уже зарегестрирован',
            'password.required' => 'Поле не должно быть пустым',
            'password.confirmed' => 'Пароль должно совпадать с полем "Потверждение пароля"',
            'password.min' => 'Пароль должен быть не менее 6 символов',
            'image.image' => 'Файл должен быть картинкой',
            'image.mimes' => 'Картинка должна быть формата jpg',
        ];
    }
}
