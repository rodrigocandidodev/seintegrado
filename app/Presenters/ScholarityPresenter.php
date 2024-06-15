<?php

namespace App\Presenters;

use App\Transformers\ScholarityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ScholarityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ScholarityTransformer();
    }
}
