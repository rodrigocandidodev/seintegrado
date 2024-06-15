<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CollaboratorJob;

/**
 * Class CollaboratorJobTransformer.
 *
 * @package namespace App\Transformers;
 */
class CollaboratorJobTransformer extends TransformerAbstract
{
    /**
     * Transform the CollaboratorJob entity.
     *
     * @param \App\Entities\CollaboratorJob $model
     *
     * @return array
     */
    public function transform(CollaboratorJob $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
