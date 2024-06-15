<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class GroupValidator.
 *
 * @package namespace App\Validators;
 */
class GroupValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'name' 			 => 'required',
        	'abbreviation' 	 => 'required | max:4',
        	'first_day' 	 => 'required',
        	'last_day'  	 => 'required',
        	'stored_by' 	 => 'required',
        	'institution_id' => 'required',
        	'school_year_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
