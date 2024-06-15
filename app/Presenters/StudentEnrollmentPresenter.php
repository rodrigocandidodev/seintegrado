<?php

namespace App\Presenters;

use App\Transformers\StudentEnrollmentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StudentEnrollmentPresenter.
 *
 * @package namespace App\Presenters;
 */
class StudentEnrollmentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StudentEnrollmentTransformer();
    }
}
