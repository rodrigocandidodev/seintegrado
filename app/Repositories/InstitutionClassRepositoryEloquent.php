<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InstitutionClassRepository;
use App\Entities\InstitutionClass;
use App\Validators\InstitutionClassValidator;

/**
 * Class InstitutionClassRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InstitutionClassRepositoryEloquent extends BaseRepository implements InstitutionClassRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InstitutionClass::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstitutionClassValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
