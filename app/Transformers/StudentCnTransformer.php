<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StudentCn;

/**
 * Class StudentCnTransformer.
 *
 * @package namespace App\Transformers;
 */
class StudentCnTransformer extends TransformerAbstract
{
    /**
     * Transform the StudentCn entity.
     *
     * @param \App\Entities\StudentCn $model
     *
     * @return array
     */
    public function transform(StudentCn $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
