<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CurricularComponentClass;

/**
 * Class CurricularComponentClassTransformer.
 *
 * @package namespace App\Transformers;
 */
class CurricularComponentClassTransformer extends TransformerAbstract
{
    /**
     * Transform the CurricularComponentClass entity.
     *
     * @param \App\Entities\CurricularComponentClass $model
     *
     * @return array
     */
    public function transform(CurricularComponentClass $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
