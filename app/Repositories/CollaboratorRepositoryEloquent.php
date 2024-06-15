<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CollaboratorRepository;
use App\Entities\Collaborator;
use App\Validators\CollaboratorValidator;

/**
 * Class CollaboratorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CollaboratorRepositoryEloquent extends BaseRepository implements CollaboratorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Collaborator::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CollaboratorValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
