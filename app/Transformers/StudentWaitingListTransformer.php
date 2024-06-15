<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StudentWaitingList;

/**
 * Class StudentWaitingListTransformer.
 *
 * @package namespace App\Transformers;
 */
class StudentWaitingListTransformer extends TransformerAbstract
{
    /**
     * Transform the StudentWaitingList entity.
     *
     * @param \App\Entities\StudentWaitingList $model
     *
     * @return array
     */
    public function transform(StudentWaitingList $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
