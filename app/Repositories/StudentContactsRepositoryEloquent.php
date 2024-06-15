<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentContactsRepository;
use App\Entities\StudentContacts;
use App\Validators\StudentContactsValidator;

/**
 * Class StudentContactsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudentContactsRepositoryEloquent extends BaseRepository implements StudentContactsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StudentContacts::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StudentContactsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
