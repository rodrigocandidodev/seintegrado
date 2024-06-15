<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class InstitutionCalendarActivityValidator.
 *
 * @package namespace App\Validators;
 */
class InstitutionCalendarActivityValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'day' 				=> 'required',
        	'motive'			=> 'required',
        	'class_day' 		=> 'required',
        	'year' 				=> 'required',
        	'institution_id' 	=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
