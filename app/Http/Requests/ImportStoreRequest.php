<?php

namespace App\Http\Requests;

use App\Rules\IsImportExists;
use Illuminate\Foundation\Http\FormRequest;

class ImportStoreRequest extends FormRequest
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
            'import_type_id' => ['required', new IsImportExists()],
            'quantity' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Все поля обязательны! Пожалуйста заполните поля!'
        ];
    }
}
