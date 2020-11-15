<?php

namespace App\Http\Requests;

use App\Rules\ValidCostPrice;
use Illuminate\Foundation\Http\FormRequest;

class MenuItemStoreRequiest extends FormRequest
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
            'display_name' => 'required',
            'price' => 'required',
            'import_type_id' => 'required',
            'cost_price' => ['required', new ValidCostPrice($this->price)]
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Все поля обязательны! Пожалуйста заполните поля!'
        ];
    }
}
