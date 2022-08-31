<?php

/**
 * Part of Dear package.
 *
 * @package Dear
 * @version 1.0
 * @author Umair Mahmood
 * @license MIT
 * @copyright Copyright (c) 2019 Umair Mahmood
 *
 */

namespace Cale\Dear\Api;

use Cale\Dear\Api\Contracts\PostMethodAllowed as PostContract;
use Cale\Dear\Api\Contracts\PutMethodAllowed as PutContract;

class SaleFulfilmentPack extends BaseApi implements PostContract, PutContract
{
    protected function getGUID()
    {
        return "TaskID";
    }

    protected function getAction()
    {
        return 'sale/fulfilment/pack';
    }
}