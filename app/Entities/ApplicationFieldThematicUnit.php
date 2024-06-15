<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ApplicationFieldThematicUnit.
 *
 * @package namespace App\Entities;
 */
class ApplicationFieldThematicUnit extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['application_field_thematic_unit','bncc_curricular_component_id'];

}
