<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Job;

/**
 * Class JobTransformer.
 *
 * @package namespace App\Transformers;
 */
class JobTransformer extends TransformerAbstract
{
    /**
     * Transform the Job entity.
     *
     * @param \App\Entities\Job $model
     *
     * @return array
     */
    public function transform(Job $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
