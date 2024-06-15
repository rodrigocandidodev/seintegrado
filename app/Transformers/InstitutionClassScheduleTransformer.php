<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\InstitutionClassSchedule;

/**
 * Class InstitutionClassScheduleTransformer.
 *
 * @package namespace App\Transformers;
 */
class InstitutionClassScheduleTransformer extends TransformerAbstract
{
    /**
     * Transform the InstitutionClassSchedule entity.
     *
     * @param \App\Entities\InstitutionClassSchedule $model
     *
     * @return array
     */
    public function transform(InstitutionClassSchedule $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
