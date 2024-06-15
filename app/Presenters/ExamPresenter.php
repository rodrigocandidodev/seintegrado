<?php

namespace App\Presenters;

use App\Transformers\ExamTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ExamPresenter.
 *
 * @package namespace App\Presenters;
 */
class ExamPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ExamTransformer();
    }
}
