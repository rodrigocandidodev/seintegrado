<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentExamResultRepository;
use App\Entities\StudentExamResult;
use App\Validators\StudentExamResultValidator;

/**
 * Class StudentExamResultRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudentExamResultRepositoryEloquent extends BaseRepository implements StudentExamResultRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StudentExamResult::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StudentExamResultValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
