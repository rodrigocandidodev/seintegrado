<?php

namespace App\Presenters;

use App\Transformers\InstitutionClassStudentSequenceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InstitutionClassStudentSequencePresenter.
 *
 * @package namespace App\Presenters;
 */
class InstitutionClassStudentSequencePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InstitutionClassStudentSequenceTransformer();
    }
}
