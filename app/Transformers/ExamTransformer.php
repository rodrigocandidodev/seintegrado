<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Exam;

/**
 * Class ExamTransformer.
 *
 * @package namespace App\Transformers;
 */
class ExamTransformer extends TransformerAbstract
{
    /**
     * Transform the Exam entity.
     *
     * @param \App\Entities\Exam $model
     *
     * @return array
     */
    public function transform(Exam $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
