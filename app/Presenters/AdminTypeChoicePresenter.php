<?php

namespace App\Presenters;

use App\Transformers\AdminTypeChoiceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AdminTypeChoicePresenter.
 *
 * @package namespace App\Presenters;
 */
class AdminTypeChoicePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminTypeChoiceTransformer();
    }
}
