<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CurricularComponentValidator.
 *
 * @package namespace App\Validators;
 */
class CurricularComponentValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'component' 		=> 'required',
        	'year' 				=> 'required',
        	'institution_id'	=> 'required',
        	'knowledge_area_id' => 'required',
            'abbreviation'      => 'required | min: 2 | max: 4'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
