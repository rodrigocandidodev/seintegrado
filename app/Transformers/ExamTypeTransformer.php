<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ExamType;

/**
 * Class ExamTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class ExamTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the ExamType entity.
     *
     * @param \App\Entities\ExamType $model
     *
     * @return array
     */
    public function transform(ExamType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
