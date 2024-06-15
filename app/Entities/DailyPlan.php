<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class DailyPlan.
 *
 * @package namespace App\Entities;
 */
class DailyPlan extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['plan_date','class_plan','teacher_id','delivery_date','plan_created_at','group_id','institution_id','school_year_division_id','school_year_id','scholarity_id'];

}
