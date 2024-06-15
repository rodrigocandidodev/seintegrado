<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentAddressRepository;
use App\Entities\StudentAddress;
use App\Validators\StudentAddressValidator;

/**
 * Class StudentAdressRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudentAddressRepositoryEloquent extends BaseRepository implements StudentAddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StudentAddress::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StudentAddressValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
