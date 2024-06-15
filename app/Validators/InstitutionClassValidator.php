<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class InstitutionClassValidator.
 *
 * @package namespace App\Validators;
 */
class InstitutionClassValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'institution_class'   =>'required',
            'grade_id'            =>'required',
            'institution_id'      =>'required',
            'school_year_id'      =>'required',
            'max_amount_student'  =>'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
