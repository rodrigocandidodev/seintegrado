<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CoreAdminValidator.
 *
 * @package namespace App\Validators;
 */
class CoreAdminValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'name' 		=> 'required',
        	'email' 	=> 'required',
        	'password' 	=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
