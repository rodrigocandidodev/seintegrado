<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CurricularComponentClassRepository;
use App\Entities\CurricularComponentClass;
use App\Validators\CurricularComponentClassValidator;

/**
 * Class CurricularComponentClassRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CurricularComponentClassRepositoryEloquent extends BaseRepository implements CurricularComponentClassRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CurricularComponentClass::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CurricularComponentClassValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
