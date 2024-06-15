<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StudentValidator.
 *
 * @package namespace App\Validators;
 */
class StudentValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'name' => 'required',
            'mother' => 'required',
            'legal_responsable' => 'required',
        	'email' => 'required',
        	'password' => 'required',
        	'date_birth' => 'required',
        	'place_birth' => 'required',
        	'auth_image_use' => 'required',
        	'institution_id' => 'required',
        	'gender_id' => 'required',
        	'color_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
