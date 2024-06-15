<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CollaboratorJob.
 *
 * @package namespace App\Entities;
 */
class CollaboratorJob extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'job_year', 'job_status', 'job_id','collaborator_id'
    ];

}
