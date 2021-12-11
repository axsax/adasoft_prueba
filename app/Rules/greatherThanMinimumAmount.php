<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class greatherThanMinimumAmount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $minimum_amount;

    public function __construct($id)
    {
        $product= Product::find($id);
       // dd($product->minimum_amount);
        $this->minimum_amount =$product->minimum_amount;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //dd($value. ' es'. $this->minimum_amount);
        return $value >= $this->minimum_amount;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'It does not exceed the minimum quantity of the product';
    }
}
