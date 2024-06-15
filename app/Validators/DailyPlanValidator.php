<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class DailyPlanValidator.
 *
 * @package namespace App\Validators;
 */
class DailyPlanValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'plan_date' 				=> 'required',
        	'class_plan'				=> 'required',
        	'teacher_id' 				=> 'required',
        	'delivery_date'				=> 'required',
        	'plan_created_at' 			=> 'required',
        	'group_id'					=> 'required',
        	'institution_id'			=> 'required',
        	'school_year_division_id' 	=> 'required',
            'school_year_id'            => 'required',
            'scholarity_id'             => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
