<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdminTypeRepository;
use App\Entities\AdminType;
use App\Validators\AdminTypeValidator;

/**
 * Class AdminTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AdminTypeRepositoryEloquent extends BaseRepository implements AdminTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdminTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
