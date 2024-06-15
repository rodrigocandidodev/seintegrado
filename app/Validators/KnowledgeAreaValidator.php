<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class KnowledgeAreaValidator.
 *
 * @package namespace App\Validators;
 */
class KnowledgeAreaValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'knowledge_area'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
