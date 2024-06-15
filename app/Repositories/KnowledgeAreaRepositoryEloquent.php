<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\KnowledgeAreaRepository;
use App\Entities\KnowledgeArea;
use App\Validators\KnowledgeAreaValidator;

/**
 * Class KnowledgeAreaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class KnowledgeAreaRepositoryEloquent extends BaseRepository implements KnowledgeAreaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return KnowledgeArea::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return KnowledgeAreaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
