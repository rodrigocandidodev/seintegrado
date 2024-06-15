<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CollaboratorAddressRepository;
use App\Entities\CollaboratorAddress;
use App\Validators\CollaboratorAddressValidator;

/**
 * Class CollaboratorAdressRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CollaboratorAddressRepositoryEloquent extends BaseRepository implements CollaboratorAddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CollaboratorAddress::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CollaboratorAddressValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
