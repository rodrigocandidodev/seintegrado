<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InstitutionClassStudentSequenceRepository;
use App\Entities\InstitutionClassStudentSequence;
use App\Validators\InstitutionClassStudentSequenceValidator;

/**
 * Class InstitutionClassStudentSequenceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InstitutionClassStudentSequenceRepositoryEloquent extends BaseRepository implements InstitutionClassStudentSequenceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InstitutionClassStudentSequence::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InstitutionClassStudentSequenceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
