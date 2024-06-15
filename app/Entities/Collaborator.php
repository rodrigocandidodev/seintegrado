<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Collaborator.
 *
 * @package namespace App\Entities;
 */
class Collaborator extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'cpf', 'rg', 'rg_emissor', 'date_birth', 'place_birth','collaborator_status', 'institution_id', 'gender_id'
    ];

}
