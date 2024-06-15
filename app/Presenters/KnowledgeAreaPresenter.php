<?php

namespace App\Presenters;

use App\Transformers\KnowledgeAreaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class KnowledgeAreaPresenter.
 *
 * @package namespace App\Presenters;
 */
class KnowledgeAreaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new KnowledgeAreaTransformer();
    }
}
