<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CollaboratorJobValidator.
 *
 * @package namespace App\Validators;
 */
class CollaboratorJobValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'job_year' 		    => 'required',
        	'job_status' 	    => 'required',
        	'job_id' 		    => 'required',
            'collaborator_id'   => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
