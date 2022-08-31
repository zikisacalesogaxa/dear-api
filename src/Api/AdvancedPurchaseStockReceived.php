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

namespace Scout\Dear\Api;

use Scout\Dear\Api\Contracts\DeleteMethodAllowed as DeleteContract;
use Scout\Dear\Api\Contracts\PostMethodAllowed as PostContract;
use Scout\Dear\Api\Contracts\PutMethodAllowed as PutContract;

class AdvancedPurchaseStockReceived extends BaseApi implements PostContract, PutContract, DeleteContract
{
    protected function getGUID()
    {
        return "PurchaseID";
    }

    protected function getAction()
    {
        return 'advanced-purchase/stock';
    }
}