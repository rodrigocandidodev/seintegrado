<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CollaboratorValidator.
 *
 * @package namespace App\Validators;
 */
class CollaboratorValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'name' 							=> 'required',
        	'cpf' 							=> 'required',
        	'rg' 							=> 'required',
        	'rg_emissor' 					=> 'required',
        	'date_birth' 					=> 'required',
        	'place_birth' 					=> 'required',
            'collaborator_status'           => 'required',
        	'institution_id' 				=> 'required',
        	'gender_id' 					=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
