<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerStoreRequest extends FormRequest
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
        return
            [
                'name' => 'required|max:200',
                'position' => 'required',
                'team' => 'required|max:100',
                'number' => 'required',
                'user_id' => 'integer',
            ]
        ;
    }
    public function messages(): array
    {
        return [
            'name.max' => 'Имя не должно превышать 200 символов',
            'name.required' => 'Имя обязательно!',
            'position.required' => 'Позиция обязательна!',
            'team.required' => 'Команда обязательна!',
            'number.required' => 'Номер игрока обязательный!'
        ];
    }
}
