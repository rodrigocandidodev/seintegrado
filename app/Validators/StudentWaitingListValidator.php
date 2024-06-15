<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StudentWaitingListValidator.
 *
 * @package namespace App\Validators;
 */
class StudentWaitingListValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'candidate_name' 		=> 'required',
        	'responsable'	 		=> 'required',
        	'phone'			 		=> 'required',
        	'institution_id' 		=> 'required',
        	'enrollment_year'		=> 'required',
        	'institution_class_id' 	=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
