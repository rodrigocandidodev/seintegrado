<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StudentMedicalCertificate;

/**
 * Class StudentMedicalCertificateTransformer.
 *
 * @package namespace App\Transformers;
 */
class StudentMedicalCertificateTransformer extends TransformerAbstract
{
    /**
     * Transform the StudentMedicalCertificate entity.
     *
     * @param \App\Entities\StudentMedicalCertificate $model
     *
     * @return array
     */
    public function transform(StudentMedicalCertificate $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
