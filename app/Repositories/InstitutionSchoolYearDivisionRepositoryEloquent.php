<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InstitutionSchoolYearDivisionRepository;
use App\Entities\InstitutionSchoolYearDivision;
use App\Validators\InstitutionSchoolYearDivisionValidator;

/**
 * Class InstitutionSchoolYearDivisionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InstitutionSchoolYearDivisionRepositoryEloquent extends BaseRepository implements InstitutionSchoolYearDivisionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InstitutionSchoolYearDivision::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstitutionSchoolYearDivisionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
