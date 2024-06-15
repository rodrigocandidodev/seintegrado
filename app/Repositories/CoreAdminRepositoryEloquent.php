<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CoreAdminRepository;
use App\Entities\CoreAdmin;
use App\Validators\CoreAdminValidator;

/**
 * Class CoreAdminRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CoreAdminRepositoryEloquent extends BaseRepository implements CoreAdminRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CoreAdmin::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CoreAdminValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
