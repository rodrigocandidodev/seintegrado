<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SchoolYearRepository;
use App\Entities\SchoolYear;
use App\Validators\SchoolYearValidator;

/**
 * Class SchoolYearRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SchoolYearRepositoryEloquent extends BaseRepository implements SchoolYearRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SchoolYear::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SchoolYearValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
