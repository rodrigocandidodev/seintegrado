<?php

namespace App\Presenters;

use App\Transformers\CollaboratorContactsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CollaboratorContactsPresenter.
 *
 * @package namespace App\Presenters;
 */
class CollaboratorContactsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CollaboratorContactsTransformer();
    }
}
