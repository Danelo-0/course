<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class AddCourseRequest extends FormRequest
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
        $date = Carbon::today();
        return [
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
            'places' => 'required|gt:0',
            'date' => 'required|after:'.$date,
            'time' => 'required',
            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле не должно быть пустым',
            'title.max' => 'В поле должно быть максимум 255 символов',
            'content.required' => 'Поле не должно быть пустым',
            'category.required' => 'Поле не должно быть пустым',
            'places.required' => 'Поле не должно быть пустым',
            'places.gt' => 'Мест должно быть больше 0',
            'date.required' => 'Поле не должно быть пустым',
            'date.after' => 'Дата не должна быть прошедшая или сегодняшняя',
            'time.required' => 'Поле не должно быть пустым',
            'image.required' => 'Поле не должно быть пустым',
        ];
    }

}
