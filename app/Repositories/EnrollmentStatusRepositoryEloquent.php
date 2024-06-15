<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EnrollmentStatusRepository;
use App\Entities\EnrollmentStatus;
use App\Validators\EnrollmentStatusValidator;

/**
 * Class EnrollmentStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EnrollmentStatusRepositoryEloquent extends BaseRepository implements EnrollmentStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EnrollmentStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EnrollmentStatusValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
