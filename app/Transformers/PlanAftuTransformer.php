<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PlanAftu;

/**
 * Class PlanAftuTransformer.
 *
 * @package namespace App\Transformers;
 */
class PlanAftuTransformer extends TransformerAbstract
{
    /**
     * Transform the PlanAftu entity.
     *
     * @param \App\Entities\PlanAftu $model
     *
     * @return array
     */
    public function transform(PlanAftu $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
