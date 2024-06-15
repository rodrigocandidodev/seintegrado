<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class TeacherClass.
 *
 * @package namespace App\Entities;
 */
class TeacherClass extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['teacher_id','curricular_component_id','institution_class_id','institution_id','school_year_id'];

}
