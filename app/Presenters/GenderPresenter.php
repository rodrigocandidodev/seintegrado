<?php

namespace App\Presenters;

use App\Transformers\GenderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GenderPresenter.
 *
 * @package namespace App\Presenters;
 */
class GenderPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GenderTransformer();
    }
}
