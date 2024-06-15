<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\InstitutionClassStudentSequence;

/**
 * Class InstitutionClassStudentSequenceTransformer.
 *
 * @package namespace App\Transformers;
 */
class InstitutionClassStudentSequenceTransformer extends TransformerAbstract
{
    /**
     * Transform the InstitutionClassStudentSequence entity.
     *
     * @param \App\Entities\InstitutionClassStudentSequence $model
     *
     * @return array
     */
    public function transform(InstitutionClassStudentSequence $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
