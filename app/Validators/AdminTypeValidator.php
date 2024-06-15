<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class AdminTypeValidator.
 *
 * @package namespace App\Validators;
 */
class AdminTypeValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'admin_type' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
