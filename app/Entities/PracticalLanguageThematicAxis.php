<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PracticalLanguageThematicAxis.
 *
 * @package namespace App\Entities;
 */
class PracticalLanguageThematicAxis extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['practical_language_thematic_axis','bncc_curricular_component_id'];

}
