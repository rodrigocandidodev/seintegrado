<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentSchoolAttendanceRepository;
use App\Entities\StudentSchoolAttendance;
use App\Validators\StudentSchoolAttendanceValidator;

/**
 * Class StudentSchoolAttendanceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudentSchoolAttendanceRepositoryEloquent extends BaseRepository implements StudentSchoolAttendanceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StudentSchoolAttendance::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StudentSchoolAttendanceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
