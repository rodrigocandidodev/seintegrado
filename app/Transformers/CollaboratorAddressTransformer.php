<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CollaboratorAddress;

/**
 * Class CollaboratorAdressTransformer.
 *
 * @package namespace App\Transformers;
 */
class CollaboratorAddressTransformer extends TransformerAbstract
{
    /**
     * Transform the CollaboratorAdress entity.
     *
     * @param \App\Entities\CollaboratorAdress $model
     *
     * @return array
     */
    public function transform(CollaboratorAddress $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
