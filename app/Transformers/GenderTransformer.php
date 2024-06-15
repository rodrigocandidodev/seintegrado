<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Gender;

/**
 * Class GenderTransformer.
 *
 * @package namespace App\Transformers;
 */
class GenderTransformer extends TransformerAbstract
{
    /**
     * Transform the Gender entity.
     *
     * @param \App\Entities\Gender $model
     *
     * @return array
     */
    public function transform(Gender $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
