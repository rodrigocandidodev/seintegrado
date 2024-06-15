<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Grade;

/**
 * Class GradeTransformer.
 *
 * @package namespace App\Transformers;
 */
class GradeTransformer extends TransformerAbstract
{
    /**
     * Transform the Grade entity.
     *
     * @param \App\Entities\Grade $model
     *
     * @return array
     */
    public function transform(Grade $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
