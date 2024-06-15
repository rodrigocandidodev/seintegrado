<?php

namespace App\Presenters;

use App\Transformers\StudentCnTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StudentCnPresenter.
 *
 * @package namespace App\Presenters;
 */
class StudentCnPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StudentCnTransformer();
    }
}
