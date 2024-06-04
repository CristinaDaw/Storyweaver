<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InArrayRule implements Rule
{
    private $validValues;

    public function __construct($validValues)
    {
        $this->validValues = $validValues;
    }

    public function passes($attribute, $value)
    {
        return in_array($value, $this->validValues);
    }

    public function message()
    {
        return 'El campo :attribute no existe en el conjunto permitido.';
    }
}
