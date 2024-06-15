<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class SchoolYearValidator.
 *
 * @package namespace App\Validators;
 */
class SchoolYearValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'year' 					=> 'required',
        	'institution_id' 		=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
