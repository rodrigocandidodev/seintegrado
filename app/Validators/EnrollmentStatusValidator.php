<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class EnrollmentStatusValidator.
 *
 * @package namespace App\Validators;
 */
class EnrollmentStatusValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'enrollment_status' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
