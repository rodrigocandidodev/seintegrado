<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CollaboratorJobRepository;
use App\Entities\CollaboratorJob;
use App\Validators\CollaboratorJobValidator;

/**
 * Class CollaboratorJobRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CollaboratorJobRepositoryEloquent extends BaseRepository implements CollaboratorJobRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CollaboratorJob::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CollaboratorJobValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
