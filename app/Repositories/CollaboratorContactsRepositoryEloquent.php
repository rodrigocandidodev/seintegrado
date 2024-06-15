<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CollaboratorContactsRepository;
use App\Entities\CollaboratorContacts;
use App\Validators\CollaboratorContactsValidator;

/**
 * Class CollaboratorContactsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CollaboratorContactsRepositoryEloquent extends BaseRepository implements CollaboratorContactsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CollaboratorContacts::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CollaboratorContactsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
