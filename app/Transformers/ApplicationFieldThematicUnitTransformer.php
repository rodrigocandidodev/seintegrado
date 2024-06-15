<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ApplicationFieldThematicUnit;

/**
 * Class ApplicationFieldThematicUnitTransformer.
 *
 * @package namespace App\Transformers;
 */
class ApplicationFieldThematicUnitTransformer extends TransformerAbstract
{
    /**
     * Transform the ApplicationFieldThematicUnit entity.
     *
     * @param \App\Entities\ApplicationFieldThematicUnit $model
     *
     * @return array
     */
    public function transform(ApplicationFieldThematicUnit $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
