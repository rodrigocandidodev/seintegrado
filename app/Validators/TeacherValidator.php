<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class TeacherValidator.
 *
 * @package namespace App\Validators;
 */
class TeacherValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'name' 				=> 'required',
        	'email' 			=> 'required',
        	'password'          => 'required', 
        	'collaborator_id'  	=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
