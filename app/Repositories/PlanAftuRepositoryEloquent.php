<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PlanAftuRepository;
use App\Entities\PlanAftu;
use App\Validators\PlanAftuValidator;

/**
 * Class PlanAftuRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PlanAftuRepositoryEloquent extends BaseRepository implements PlanAftuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PlanAftu::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PlanAftuValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
