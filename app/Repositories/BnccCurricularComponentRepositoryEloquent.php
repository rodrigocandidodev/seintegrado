<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BnccCurricularComponentRepository;
use App\Entities\BnccCurricularComponent;
use App\Validators\BnccCurricularComponentValidator;

/**
 * Class BnccCurricularComponentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BnccCurricularComponentRepositoryEloquent extends BaseRepository implements BnccCurricularComponentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BnccCurricularComponent::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BnccCurricularComponentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
