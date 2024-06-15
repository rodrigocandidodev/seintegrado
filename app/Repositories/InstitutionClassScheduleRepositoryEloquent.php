<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InstitutionClassScheduleRepository;
use App\Entities\InstitutionClassSchedule;
use App\Validators\InstitutionClassScheduleValidator;

/**
 * Class InstitutionClassScheduleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InstitutionClassScheduleRepositoryEloquent extends BaseRepository implements InstitutionClassScheduleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InstitutionClassSchedule::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstitutionClassScheduleValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
