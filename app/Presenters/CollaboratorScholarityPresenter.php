<?php

namespace App\Presenters;

use App\Transformers\CollaboratorScholarityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;


class CollaboratorScholarityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CollaboratorScholarityTransformer();
    }
}
