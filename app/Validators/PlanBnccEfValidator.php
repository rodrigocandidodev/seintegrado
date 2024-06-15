<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PlanBnccEfValidator.
 *
 * @package namespace App\Validators;
 */
class PlanBnccEfValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'title_theme'							=> 'required',
        	'daily_plan_id'							=> 'required',
        	'curricular_component_id'				=> 'required',
        	'application_field_thematic_unit_id'	=> 'required',
        	'practical_language_thematic_axis_id'	=> 'required',
        	'prior_knowledge'						=> 'required',
        	'practical_aplication'					=> 'required',
        	'evaluation'							=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
