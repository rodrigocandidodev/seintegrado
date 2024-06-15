<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class InstitutionCalendarValidator.
 *
 * @package namespace App\Validators;
 */
class InstitutionCalendarValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'day' 			=> 'required',
        	'activity_id' 	=> 'required',
        	'motive' 		=> 'required',
        	'class_day' 	=> 'required',
        	'year' 			=> 'required',
        	'institution_id'=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
