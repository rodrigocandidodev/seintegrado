<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StudentCnValidator.
 *
 * @package namespace App\Validators;
 */
class StudentCnValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'student_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
