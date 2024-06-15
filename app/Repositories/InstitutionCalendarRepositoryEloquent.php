<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InstitutionCalendarRepository;
use App\Entities\InstitutionCalendar;
use App\Validators\InstitutionCalendarValidator;

/**
 * Class InstitutionCalendarRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InstitutionCalendarRepositoryEloquent extends BaseRepository implements InstitutionCalendarRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InstitutionCalendar::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstitutionCalendarValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
