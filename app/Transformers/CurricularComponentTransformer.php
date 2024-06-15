<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CurricularComponent;

/**
 * Class CurricularComponentTransformer.
 *
 * @package namespace App\Transformers;
 */
class CurricularComponentTransformer extends TransformerAbstract
{
    /**
     * Transform the CurricularComponent entity.
     *
     * @param \App\Entities\CurricularComponent $model
     *
     * @return array
     */
    public function transform(CurricularComponent $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
