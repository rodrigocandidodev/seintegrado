<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class JobValidator.
 *
 * @package namespace App\Validators;
 */
class JobValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'office' 		=> 'required',
        	'department_id' => 'required',
        	'institution_id'=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
