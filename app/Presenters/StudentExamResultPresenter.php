<?php

namespace App\Presenters;

use App\Transformers\StudentExamResultTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StudentExamResultPresenter.
 *
 * @package namespace App\Presenters;
 */
class StudentExamResultPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StudentExamResultTransformer();
    }
}
