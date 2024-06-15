<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AdminTypeChoice;

/**
 * Class AdminTypeChoiceTransformer.
 *
 * @package namespace App\Transformers;
 */
class AdminTypeChoiceTransformer extends TransformerAbstract
{
    /**
     * Transform the AdminTypeChoice entity.
     *
     * @param \App\Entities\AdminTypeChoice $model
     *
     * @return array
     */
    public function transform(AdminTypeChoice $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
