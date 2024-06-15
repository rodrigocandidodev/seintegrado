<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Exam.
 *
 * @package namespace App\Entities;
 */
class Exam extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['exam','exam_date','value','teacher_id','division_id','school_year_id','curricular_component_id','institution_id','institution_class_id'];

}
