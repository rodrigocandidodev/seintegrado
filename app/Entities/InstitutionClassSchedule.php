<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InstitutionClassSchedule.
 *
 * @package namespace App\Entities;
 */
class InstitutionClassSchedule extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['hour','week_day','institution_class_id','curricular_component_id','institution_id','school_year_id','sequence'];

}
