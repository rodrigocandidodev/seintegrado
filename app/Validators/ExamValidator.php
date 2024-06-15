<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ExamValidator.
 *
 * @package namespace App\Validators;
 */
class ExamValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'exam_type'		=> 'required',
        	'institution_id'=> 'required',
        	'school_year_id'=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'exam_type'		=> 'required',
        ],
    ];
}
