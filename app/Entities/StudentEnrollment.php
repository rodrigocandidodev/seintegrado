<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class StudentEnrollment.
 *
 * @package namespace App\Entities;
 */
class StudentEnrollment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'enrollment_code','enrollment_number','enrollment_date','transfer_date','transfer_type','enrollment_year', 'degree_relatedness', 'name', 'cpf', 'rg', 'rg_emissor', 'institution_class_id','enrollment_applicant_id','enrollment_status_id','student_id','institution_id','collaborator_id'
    ];

}
