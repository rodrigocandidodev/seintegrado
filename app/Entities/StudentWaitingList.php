<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class StudentWaitingList.
 *
 * @package namespace App\Entities;
 */
class StudentWaitingList extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['candidate_name','responsable','phone','institution_id','enrollment_year','institution_class_id'];

}
