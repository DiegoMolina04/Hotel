<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArraysCannotShareValues implements Rule
{
    protected $otherArray;

    public function __construct($otherArray)
    {
        $this->otherArray = $otherArray;
    }

    public function passes($attribute, $value)
    {
        if($this->otherArray == null){
            return true;
        }
        foreach ($value as $item) {
            if (in_array($item, $this->otherArray)) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'Los grupos no pueden repetir valores';
    }
}
