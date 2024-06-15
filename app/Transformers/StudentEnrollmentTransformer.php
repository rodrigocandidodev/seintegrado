<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StudentEnrollment;

/**
 * Class StudentEnrollmentTransformer.
 *
 * @package namespace App\Transformers;
 */
class StudentEnrollmentTransformer extends TransformerAbstract
{
    /**
     * Transform the StudentEnrollment entity.
     *
     * @param \App\Entities\StudentEnrollment $model
     *
     * @return array
     */
    public function transform(StudentEnrollment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
