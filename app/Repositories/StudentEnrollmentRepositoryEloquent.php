<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentEnrollmentRepository;
use App\Entities\StudentEnrollment;
use App\Validators\StudentEnrollmentValidator;

/**
 * Class StudentEnrollmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudentEnrollmentRepositoryEloquent extends BaseRepository implements StudentEnrollmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StudentEnrollment::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StudentEnrollmentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
