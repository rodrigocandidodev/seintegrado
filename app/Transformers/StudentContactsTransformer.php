<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StudentContacts;

/**
 * Class StudentContactsTransformer.
 *
 * @package namespace App\Transformers;
 */
class StudentContactsTransformer extends TransformerAbstract
{
    /**
     * Transform the StudentContacts entity.
     *
     * @param \App\Entities\StudentContacts $model
     *
     * @return array
     */
    public function transform(StudentContacts $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
