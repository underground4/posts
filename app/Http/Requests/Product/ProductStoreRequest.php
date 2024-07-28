<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',
            'description' => 'required|string|max:1000',
            'price' => 'required',
            'images' => 'array|max:3'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название обязательное поле',
            'name.max' => 'Превышен лимит символов в названии продукта',
            'description.required' => 'Описание обязательное поле',
            'description.max' => 'Превышен лимит символов в описании продукта',
            'price.required' => 'Цена обязательное поле',
            'images.max' => 'Превышен лимит загружаемых фотографий',
        ];
    }
}
