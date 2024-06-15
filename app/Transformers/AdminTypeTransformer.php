<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AdminType;

/**
 * Class AdminTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class AdminTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the AdminType entity.
     *
     * @param \App\Entities\AdminType $model
     *
     * @return array
     */
    public function transform(AdminType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
