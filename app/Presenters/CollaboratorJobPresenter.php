<?php

namespace App\Presenters;

use App\Transformers\CollaboratorJobTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CollaboratorJobPresenter.
 *
 * @package namespace App\Presenters;
 */
class CollaboratorJobPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CollaboratorJobTransformer();
    }
}
