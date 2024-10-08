<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DailyPlanRepository;
use App\Entities\DailyPlan;
use App\Validators\DailyPlanValidator;

/**
 * Class DailyPlanRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DailyPlanRepositoryEloquent extends BaseRepository implements DailyPlanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DailyPlan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DailyPlanValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
