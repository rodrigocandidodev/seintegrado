<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TeacherClass;

/**
 * Class TeacherClassTransformer.
 *
 * @package namespace App\Transformers;
 */
class TeacherClassTransformer extends TransformerAbstract
{
    /**
     * Transform the TeacherClass entity.
     *
     * @param \App\Entities\TeacherClass $model
     *
     * @return array
     */
    public function transform(TeacherClass $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
