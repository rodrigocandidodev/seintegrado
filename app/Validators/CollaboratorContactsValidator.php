<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CollaboratorContactsValidator.
 *
 * @package namespace App\Validators;
 */
class CollaboratorContactsValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'collaborator_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
