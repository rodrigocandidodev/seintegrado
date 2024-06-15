<?php

namespace App\Presenters;

use App\Transformers\StudentMedicalCertificateTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StudentMedicalCertificatePresenter.
 *
 * @package namespace App\Presenters;
 */
class StudentMedicalCertificatePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StudentMedicalCertificateTransformer();
    }
}
