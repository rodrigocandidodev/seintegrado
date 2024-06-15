<?php

namespace App\Presenters;

use App\Transformers\StudentWaitingListTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StudentWaitingListPresenter.
 *
 * @package namespace App\Presenters;
 */
class StudentWaitingListPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StudentWaitingListTransformer();
    }
}
