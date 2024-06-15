<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class DepartmentValidator.
 *
 * @package namespace App\Validators;
 */
class DepartmentValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'department' 	=> 'required',
        	'institution_id'=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
