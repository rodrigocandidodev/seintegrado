<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TeacherClassRepository;
use App\Entities\TeacherClass;
use App\Validators\TeacherClassValidator;

/**
 * Class TeacherClassRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TeacherClassRepositoryEloquent extends BaseRepository implements TeacherClassRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TeacherClass::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TeacherClassValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
