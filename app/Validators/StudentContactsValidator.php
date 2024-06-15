<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StudentContactsValidator.
 *
 * @package namespace App\Validators;
 */
class StudentContactsValidator extends LaravelValidator
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
