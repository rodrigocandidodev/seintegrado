<?php

namespace App\Presenters;

use App\Transformers\CollaboratorAddressTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CollaboratorAdressPresenter.
 *
 * @package namespace App\Presenters;
 */
class CollaboratorAddressPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CollaboratorAddressTransformer();
    }
}
