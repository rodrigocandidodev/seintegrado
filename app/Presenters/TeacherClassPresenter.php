<?php

namespace App\Presenters;

use App\Transformers\TeacherClassTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TeacherClassPresenter.
 *
 * @package namespace App\Presenters;
 */
class TeacherClassPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TeacherClassTransformer();
    }
}
