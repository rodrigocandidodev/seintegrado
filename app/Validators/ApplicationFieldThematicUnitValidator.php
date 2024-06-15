<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ApplicationFieldThematicUnitValidator.
 *
 * @package namespace App\Validators;
 */
class ApplicationFieldThematicUnitValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'application_field_thematic_unit' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
