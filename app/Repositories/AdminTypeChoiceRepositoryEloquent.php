<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdminTypeChoiceRepository;
use App\Entities\AdminTypeChoice;
use App\Validators\AdminTypeChoiceValidator;

/**
 * Class AdminTypeChoiceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AdminTypeChoiceRepositoryEloquent extends BaseRepository implements AdminTypeChoiceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminTypeChoice::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdminTypeChoiceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
