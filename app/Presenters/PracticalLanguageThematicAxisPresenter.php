<?php

namespace App\Presenters;

use App\Transformers\PracticalLanguageThematicAxisTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PracticalLanguageThematicAxisPresenter.
 *
 * @package namespace App\Presenters;
 */
class PracticalLanguageThematicAxisPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PracticalLanguageThematicAxisTransformer();
    }
}
