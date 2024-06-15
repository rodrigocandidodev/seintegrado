<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class StudentSchoolAttendance.
 *
 * @package namespace App\Entities;
 */
class StudentSchoolAttendance extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['day','student_id','institution_class_schedule_id','institution_id'];

}
