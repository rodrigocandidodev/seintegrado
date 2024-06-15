<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ExamTypeRepository;
use App\Entities\ExamType;
use App\Validators\ExamTypeValidator;

/**
 * Class ExamTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ExamTypeRepositoryEloquent extends BaseRepository implements ExamTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ExamType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ExamTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
