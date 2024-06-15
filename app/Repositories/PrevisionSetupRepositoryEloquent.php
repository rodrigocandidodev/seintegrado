<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PrevisionSetupRepository;
use App\Entities\PrevisionSetup;
use App\Validators\PrevisionSetupValidator;

/**
 * Class PrevisionSetupRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PrevisionSetupRepositoryEloquent extends BaseRepository implements PrevisionSetupRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PrevisionSetup::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PrevisionSetupValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
