<?php

namespace App\Presenters;

use App\Transformers\ApplicationFieldThematicUnitTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ApplicationFieldThematicUnitPresenter.
 *
 * @package namespace App\Presenters;
 */
class ApplicationFieldThematicUnitPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ApplicationFieldThematicUnitTransformer();
    }
}
