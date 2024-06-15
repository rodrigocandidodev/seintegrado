<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\InstitutionSchoolYearDivision;

/**
 * Class InstitutionSchoolYearDivisionTransformer.
 *
 * @package namespace App\Transformers;
 */
class InstitutionSchoolYearDivisionTransformer extends TransformerAbstract
{
    /**
     * Transform the InstitutionSchoolYearDivision entity.
     *
     * @param \App\Entities\InstitutionSchoolYearDivision $model
     *
     * @return array
     */
    public function transform(InstitutionSchoolYearDivision $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
