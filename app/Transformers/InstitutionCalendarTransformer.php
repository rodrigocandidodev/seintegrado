<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\InstitutionCalendar;

/**
 * Class InstitutionCalendarTransformer.
 *
 * @package namespace App\Transformers;
 */
class InstitutionCalendarTransformer extends TransformerAbstract
{
    /**
     * Transform the InstitutionCalendar entity.
     *
     * @param \App\Entities\InstitutionCalendar $model
     *
     * @return array
     */
    public function transform(InstitutionCalendar $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
