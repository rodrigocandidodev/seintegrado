<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StudentMedicalCertificateRepository;
use App\Entities\StudentMedicalCertificate;
use App\Validators\StudentMedicalCertificateValidator;

/**
 * Class StudentMedicalCertificateRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StudentMedicalCertificateRepositoryEloquent extends BaseRepository implements StudentMedicalCertificateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StudentMedicalCertificate::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StudentMedicalCertificateValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
