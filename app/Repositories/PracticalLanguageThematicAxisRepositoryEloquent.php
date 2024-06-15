<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PracticalLanguageThematicAxisRepository;
use App\Entities\PracticalLanguageThematicAxis;
use App\Validators\PracticalLanguageThematicAxisValidator;

/**
 * Class PracticalLanguageThematicAxisRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PracticalLanguageThematicAxisRepositoryEloquent extends BaseRepository implements PracticalLanguageThematicAxisRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PracticalLanguageThematicAxis::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PracticalLanguageThematicAxisValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
