<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CollaboratorContacts;

/**
 * Class CollaboratorContactsTransformer.
 *
 * @package namespace App\Transformers;
 */
class CollaboratorContactsTransformer extends TransformerAbstract
{
    /**
     * Transform the CollaboratorContacts entity.
     *
     * @param \App\Entities\CollaboratorContacts $model
     *
     * @return array
     */
    public function transform(CollaboratorContacts $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
