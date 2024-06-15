<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CollaboratorScholarityValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'scholarity_id'   => 'required',
            'collaborator_id'  => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
