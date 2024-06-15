<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class InstitutionSchoolYearDivisionValidator.
 *
 * @package namespace App\Validators;
 */
class InstitutionSchoolYearDivisionValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'division'		 => 'required',
        	'institution_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'division'       => 'required'
        ],
    ];
}
