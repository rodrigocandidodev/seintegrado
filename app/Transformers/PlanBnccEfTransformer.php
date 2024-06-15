<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PlanBnccEf;

/**
 * Class PlanBnccEfTransformer.
 *
 * @package namespace App\Transformers;
 */
class PlanBnccEfTransformer extends TransformerAbstract
{
    /**
     * Transform the PlanBnccEf entity.
     *
     * @param \App\Entities\PlanBnccEf $model
     *
     * @return array
     */
    public function transform(PlanBnccEf $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
