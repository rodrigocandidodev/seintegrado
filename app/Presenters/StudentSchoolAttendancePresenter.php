<?php

namespace App\Presenters;

use App\Transformers\StudentSchoolAttendanceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StudentSchoolAttendancePresenter.
 *
 * @package namespace App\Presenters;
 */
class StudentSchoolAttendancePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StudentSchoolAttendanceTransformer();
    }
}
