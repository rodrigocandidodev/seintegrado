<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class StudentAdress.
 *
 * @package namespace App\Entities;
 */
class StudentAddress extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'street', 'block', 'land_lot', 'number', 'neighborhood', 'zipcode','complement', 'student_id','enrollment_year'
    ];

}
