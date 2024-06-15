<?php

namespace App\Presenters;

use App\Transformers\PrevisionSetupTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PrevisionSetupPresenter.
 *
 * @package namespace App\Presenters;
 */
class PrevisionSetupPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PrevisionSetupTransformer();
    }
}
