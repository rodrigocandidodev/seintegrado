<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\EnrollmentStatus;

/**
 * Class EnrollmentStatusTransformer.
 *
 * @package namespace App\Transformers;
 */
class EnrollmentStatusTransformer extends TransformerAbstract
{
    /**
     * Transform the EnrollmentStatus entity.
     *
     * @param \App\Entities\EnrollmentStatus $model
     *
     * @return array
     */
    public function transform(EnrollmentStatus $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
