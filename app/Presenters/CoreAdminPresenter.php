<?php

namespace App\Presenters;

use App\Transformers\CoreAdminTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CoreAdminPresenter.
 *
 * @package namespace App\Presenters;
 */
class CoreAdminPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CoreAdminTransformer();
    }
}
