<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCostPrice implements Rule
{
    private $price;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($price)
    {
        $this->price = $price;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $costPrice)
    {
        return $this->price - $costPrice > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ой да бросьте, разве себестоимость больше чем цена??';
    }
}
