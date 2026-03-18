<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreStoreRequest extends FormRequest
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
                'player_id' => 'required',
                'x' => 'required',
                'y' => 'required',
                'type' => 'required',
                'result' => 'required'
            ]
        ;
    }
    public function messages(): array
    {
        return [
            'player_id.required' => 'Указать игрока - обязательно!',
            'type.required' => 'Вид атаки - обязательный!',
            'x.required' => 'Зона из которой производится атака - обязательна!',
            'y.required' => 'Зона в которую производится атака - обязательна!',
            'result.required' => 'Результат атаки - обязательный!'
        ];
    }
}
