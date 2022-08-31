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

class SaleCreditNote extends BaseApi implements PostContract, DeleteContract
{
    protected function getGUID()
    {
        return "SaleID";
    }

    protected function getAction()
    {
        return 'sale/creditnote';
    }
}