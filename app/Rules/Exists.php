<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Exists implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        if(!preg_match("/^[a-zA-Z0-9]+$/", $value)){
            $fail('The :attribute must be alphabet or number.')->translate();
        }
    }

    // protected $modelName;
    // protected $propertyName;

    // public function __construct(string $modelName, ?string $propertyName = null)
    // {
    //     $this->modelName = $modelName;
    //     $this->propertyName = $propertyName;
    // }

    // public function passes($attribute, $value)
    // {
    //     if ($this->propertyName === null) {
    //         $this->propertyName = $attribute;
    //     }

    //     return $this->modelName::where($this->propertyName, $value)->exists();
    // }

    // public function message()
    // {
    //     return ':attribute はデータが存在しません';
    // }
}