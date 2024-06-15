<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\InstitutionCalendarActivity;

/**
 * Class InstitutionCalendarActivityTransformer.
 *
 * @package namespace App\Transformers;
 */
class InstitutionCalendarActivityTransformer extends TransformerAbstract
{
    /**
     * Transform the InstitutionCalendarActivity entity.
     *
     * @param \App\Entities\InstitutionCalendarActivity $model
     *
     * @return array
     */
    public function transform(InstitutionCalendarActivity $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
