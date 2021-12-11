<?php

namespace App\Http\Requests;

use App\Rules\greatherThanMinimumAmount;
use Illuminate\Foundation\Http\FormRequest;

class PostStockUpdateRequest extends FormRequest
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
            'quantity' => ['required','integer', new greatherThanMinimumAmount($this->product_id)]
        ];
    }
}
