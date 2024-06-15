<?php

namespace App\Presenters;

use App\Transformers\ExamTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ExamTypePresenter.
 *
 * @package namespace App\Presenters;
 */
class ExamTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ExamTypeTransformer();
    }
}
