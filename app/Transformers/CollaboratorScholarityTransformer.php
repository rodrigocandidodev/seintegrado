<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CollaboratorScholarity;

class CollaboratorScholarityTransformer extends TransformerAbstract
{

    public function transform(CollaboratorScholarity $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
