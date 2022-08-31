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

class PurchaseCreditNote extends BaseApi implements PostContract
{
    protected function getGUID()
    {
        return "TaskID";
    }

    protected function getAction()
    {
        return 'purchase/creditnote';
    }
}