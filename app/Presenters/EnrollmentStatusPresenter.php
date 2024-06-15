<?php

namespace App\Presenters;

use App\Transformers\EnrollmentStatusTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EnrollmentStatusPresenter.
 *
 * @package namespace App\Presenters;
 */
class EnrollmentStatusPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EnrollmentStatusTransformer();
    }
}
