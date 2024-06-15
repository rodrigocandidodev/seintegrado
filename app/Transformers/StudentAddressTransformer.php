<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StudentAddress;

/**
 * Class StudentAdressTransformer.
 *
 * @package namespace App\Transformers;
 */
class StudentAddressTransformer extends TransformerAbstract
{
    /**
     * Transform the StudentAdress entity.
     *
     * @param \App\Entities\StudentAdress $model
     *
     * @return array
     */
    public function transform(StudentAddress $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
