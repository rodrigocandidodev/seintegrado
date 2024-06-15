<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PrevisionSetup;

/**
 * Class PrevisionSetupTransformer.
 *
 * @package namespace App\Transformers;
 */
class PrevisionSetupTransformer extends TransformerAbstract
{
    /**
     * Transform the PrevisionSetup entity.
     *
     * @param \App\Entities\PrevisionSetup $model
     *
     * @return array
     */
    public function transform(PrevisionSetup $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
