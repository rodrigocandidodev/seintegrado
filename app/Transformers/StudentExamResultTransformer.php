<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StudentExamResult;

/**
 * Class StudentExamResultTransformer.
 *
 * @package namespace App\Transformers;
 */
class StudentExamResultTransformer extends TransformerAbstract
{
    /**
     * Transform the StudentExamResult entity.
     *
     * @param \App\Entities\StudentExamResult $model
     *
     * @return array
     */
    public function transform(StudentExamResult $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
