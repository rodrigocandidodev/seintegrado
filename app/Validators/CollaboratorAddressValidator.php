<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class CollaboratorAdressValidator.
 *
 * @package namespace App\Validators;
 */
class CollaboratorAddressValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'zipcode'           => 'required',
            'collaborator_id'   => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
