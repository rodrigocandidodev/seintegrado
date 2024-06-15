<?php

namespace App\Presenters;

use App\Transformers\InstitutionCalendarTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InstitutionCalendarPresenter.
 *
 * @package namespace App\Presenters;
 */
class InstitutionCalendarPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InstitutionCalendarTransformer();
    }
}
