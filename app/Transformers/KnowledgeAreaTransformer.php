<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\KnowledgeArea;

/**
 * Class KnowledgeAreaTransformer.
 *
 * @package namespace App\Transformers;
 */
class KnowledgeAreaTransformer extends TransformerAbstract
{
    /**
     * Transform the KnowledgeArea entity.
     *
     * @param \App\Entities\KnowledgeArea $model
     *
     * @return array
     */
    public function transform(KnowledgeArea $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
