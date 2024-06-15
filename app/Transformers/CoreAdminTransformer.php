<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CoreAdmin;

/**
 * Class CoreAdminTransformer.
 *
 * @package namespace App\Transformers;
 */
class CoreAdminTransformer extends TransformerAbstract
{
    /**
     * Transform the CoreAdmin entity.
     *
     * @param \App\Entities\CoreAdmin $model
     *
     * @return array
     */
    public function transform(CoreAdmin $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
