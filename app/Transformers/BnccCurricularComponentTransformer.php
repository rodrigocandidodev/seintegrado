<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\BnccCurricularComponent;

/**
 * Class BnccCurricularComponentTransformer.
 *
 * @package namespace App\Transformers;
 */
class BnccCurricularComponentTransformer extends TransformerAbstract
{
    /**
     * Transform the BnccCurricularComponent entity.
     *
     * @param \App\Entities\BnccCurricularComponent $model
     *
     * @return array
     */
    public function transform(BnccCurricularComponent $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
