<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StudentEnrollmentValidator.
 *
 * @package namespace App\Validators;
 */
class StudentEnrollmentValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'institution_class_id' 	=> 'required',
        	'degree_relatedness'    => 'required',
            'name'                  => 'required',
        	'enrollment_status_id'  => 'required',
            'student_id'            => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
