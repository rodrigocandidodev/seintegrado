<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class GradeValidator.
 *
 * @package namespace App\Validators;
 */
class GradeValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'grade' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
