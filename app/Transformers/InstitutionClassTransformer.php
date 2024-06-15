<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\InstitutionClass;

/**
 * Class InstitutionClassTransformer.
 *
 * @package namespace App\Transformers;
 */
class InstitutionClassTransformer extends TransformerAbstract
{
    /**
     * Transform the InstitutionClass entity.
     *
     * @param \App\Entities\InstitutionClass $model
     *
     * @return array
     */
    public function transform(InstitutionClass $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
