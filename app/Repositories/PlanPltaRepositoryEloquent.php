<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PlanPltaRepository;
use App\Entities\PlanPlta;
use App\Validators\PlanPltaValidator;

/**
 * Class PlanPltaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PlanPltaRepositoryEloquent extends BaseRepository implements PlanPltaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PlanPlta::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PlanPltaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
