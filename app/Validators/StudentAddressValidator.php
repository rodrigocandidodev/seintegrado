<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StudentAdressValidator.
 *
 * @package namespace App\Validators;
 */
class StudentAddressValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'enrollment_year' => 'required',
        	'zipcode'         => 'required',
            'student_id'      => 'required'
        ],        ValidatorInterface::RULE_UPDATE => [],
    ];
}
