<?php

namespace App\Presenters;

use App\Transformers\StudentAddressTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StudentAdressPresenter.
 *
 * @package namespace App\Presenters;
 */
class StudentAddressPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StudentAddressTransformer();
    }
}
