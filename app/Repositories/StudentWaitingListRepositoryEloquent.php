<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentWaitingListRepository;
use App\Entities\StudentWaitingList;
use App\Validators\StudentWaitingListValidator;

/**
 * Class StudentWaitingListRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudentWaitingListRepositoryEloquent extends BaseRepository implements StudentWaitingListRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StudentWaitingList::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StudentWaitingListValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
