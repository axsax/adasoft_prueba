<?php

namespace App\Rules;

use App\Models\Stock;
use Illuminate\Contracts\Validation\Rule;
use Cart;
class withStock implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $errors='';
    public function __construct()
    {
        foreach(Cart::content() as $row) {
            $match =['product_id' => $row->id];
            $stock = Stock::where($match)->get()->first();
            if($row->qty > $stock->quantity){
                $this->errors .= "We don't have the enough quantity for the product $row->name , only avaliable $stock->quantity";
            }
        }
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
        return ($this->errors=='');

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errors;
    }
}
