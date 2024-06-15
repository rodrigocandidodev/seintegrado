<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PlanPlta;

/**
 * Class PlanPltaTransformer.
 *
 * @package namespace App\Transformers;
 */
class PlanPltaTransformer extends TransformerAbstract
{
    /**
     * Transform the PlanPlta entity.
     *
     * @param \App\Entities\PlanPlta $model
     *
     * @return array
     */
    public function transform(PlanPlta $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
