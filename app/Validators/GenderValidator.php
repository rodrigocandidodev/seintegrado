<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class GenderValidator.
 *
 * @package namespace App\Validators;
 */
class GenderValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'gender' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
