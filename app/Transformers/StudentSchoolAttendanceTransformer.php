<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StudentSchoolAttendance;

/**
 * Class StudentSchoolAttendanceTransformer.
 *
 * @package namespace App\Transformers;
 */
class StudentSchoolAttendanceTransformer extends TransformerAbstract
{
    /**
     * Transform the StudentSchoolAttendance entity.
     *
     * @param \App\Entities\StudentSchoolAttendance $model
     *
     * @return array
     */
    public function transform(StudentSchoolAttendance $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
