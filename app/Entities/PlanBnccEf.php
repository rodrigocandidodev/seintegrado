<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PlanBnccEf.
 *
 * @package namespace App\Entities;
 */
class PlanBnccEf extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title_theme','daily_plan_id','curricular_component_id','prior_knowledge','materials_required','practical_application','evaluation'];

}
