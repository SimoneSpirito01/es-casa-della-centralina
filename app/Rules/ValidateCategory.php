<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class ValidateCategory implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($technicianId)
    {
        $this->technicianId = $technicianId;
    }

    public $technicianId;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $technician = User::find($this->technicianId);

        $validate = false;

        foreach ($technician->workGroups as $workGroup) {
            foreach ($workGroup->categories as $category) {
                if($category->id == $value) $validate = true;
            }
        }

        return $validate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The technician does not have the permissions to open an intervention with this category.';
    }
}
