<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentCnRepository;
use App\Entities\StudentCn;
use App\Validators\StudentCnValidator;

/**
 * Class StudentCnRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudentCnRepositoryEloquent extends BaseRepository implements StudentCnRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StudentCn::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StudentCnValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
