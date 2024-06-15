<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CollaboratorScholarityRepository;
use App\Entities\CollaboratorScholarity;
use App\Validators\CollaboratorScholarityValidator;

class CollaboratorScholarityRepositoryEloquent extends BaseRepository implements CollaboratorScholarityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CollaboratorScholarity::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CollaboratorScholarityValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
