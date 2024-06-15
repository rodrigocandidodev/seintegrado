<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PracticalLanguageThematicAxis;

/**
 * Class PracticalLanguageThematicAxisTransformer.
 *
 * @package namespace App\Transformers;
 */
class PracticalLanguageThematicAxisTransformer extends TransformerAbstract
{
    /**
     * Transform the PracticalLanguageThematicAxis entity.
     *
     * @param \App\Entities\PracticalLanguageThematicAxis $model
     *
     * @return array
     */
    public function transform(PracticalLanguageThematicAxis $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
