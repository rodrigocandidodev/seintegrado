<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InstitutionCalendarActivityRepository;
use App\Entities\InstitutionCalendarActivity;
use App\Validators\InstitutionCalendarActivityValidator;

/**
 * Class InstitutionCalendarActivityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InstitutionCalendarActivityRepositoryEloquent extends BaseRepository implements InstitutionCalendarActivityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InstitutionCalendarActivity::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstitutionCalendarActivityValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
