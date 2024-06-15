<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SchoolYear;

/**
 * Class SchoolYearTransformer.
 *
 * @package namespace App\Transformers;
 */
class SchoolYearTransformer extends TransformerAbstract
{
    /**
     * Transform the SchoolYear entity.
     *
     * @param \App\Entities\SchoolYear $model
     *
     * @return array
     */
    public function transform(SchoolYear $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
