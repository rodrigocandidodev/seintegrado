<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StudentExamResultValidator.
 *
 * @package namespace App\Validators;
 */
class StudentExamResultValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'exam_id' 		=> 'required',
        	'student_id'	=> 'required',
        	'result'		=> 'required',
        	'school_year_id'=> 'required',
        	'stored_by'		=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'result'        => 'required'
        ],
    ];
}
