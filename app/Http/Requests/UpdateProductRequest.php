<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
         return [
        'product_name' => ['required','string','max:255'],
        'description' => ['required','string'],
        'brand' => ['nullable','string','max:255'],
        'quantity' => ['required','integer','min:0'],
        'price' => ['required','numeric','min:0'],
        'alert_stock' => ['nullable','integer','min:0']
        ];
    }
}
