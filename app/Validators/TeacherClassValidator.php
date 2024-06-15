<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class TeacherClassValidator.
 *
 * @package namespace App\Validators;
 */
class TeacherClassValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'teacher_id' 				=> 'required',
        	'curricular_component_id'	=> 'required',
        	'institution_class_id'		=> 'required',
        	'institution_id'			=> 'required',
        	'school_year_id'			=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
