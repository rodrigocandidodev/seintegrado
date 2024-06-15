<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CurricularComponentRepository;
use App\Entities\CurricularComponent;
use App\Validators\CurricularComponentValidator;

/**
 * Class CurricularComponentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CurricularComponentRepositoryEloquent extends BaseRepository implements CurricularComponentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CurricularComponent::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CurricularComponentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
