<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\DailyPlan;

/**
 * Class DailyPlanTransformer.
 *
 * @package namespace App\Transformers;
 */
class DailyPlanTransformer extends TransformerAbstract
{
    /**
     * Transform the DailyPlan entity.
     *
     * @param \App\Entities\DailyPlan $model
     *
     * @return array
     */
    public function transform(DailyPlan $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
