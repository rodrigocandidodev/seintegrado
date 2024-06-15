<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PracticalLanguageThematicAxisValidator.
 *
 * @package namespace App\Validators;
 */
class PracticalLanguageThematicAxisValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'practical_language_thematic_axis' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
