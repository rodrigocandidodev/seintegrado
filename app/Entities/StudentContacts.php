<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class StudentContacts.
 *
 * @package namespace App\Entities;
 */
class StudentContacts extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'phone1','phone1_responsable',
    	'phone2','phone2_responsable',
    	'phone3','phone3_responsable',
        'student_id', 'enrollment_year'
    ];

}
