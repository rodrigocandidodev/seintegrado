<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ApplicationFieldThematicUnitRepository;
use App\Entities\ApplicationFieldThematicUnit;
use App\Validators\ApplicationFieldThematicUnitValidator;

/**
 * Class ApplicationFieldThematicUnitRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ApplicationFieldThematicUnitRepositoryEloquent extends BaseRepository implements ApplicationFieldThematicUnitRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ApplicationFieldThematicUnit::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ApplicationFieldThematicUnitValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
