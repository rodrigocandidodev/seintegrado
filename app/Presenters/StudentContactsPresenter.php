<?php

namespace App\Presenters;

use App\Transformers\StudentContactsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StudentContactsPresenter.
 *
 * @package namespace App\Presenters;
 */
class StudentContactsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StudentContactsTransformer();
    }
}
