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

use Scout\Dear\Api\Contracts\PostMethodAllowed as PostContract;
use Scout\Dear\Api\Contracts\PutMethodAllowed as PutContract;

class ProductFamily extends BaseApi implements PostContract, PutContract
{
    protected function getGUID()
    {
        return "ID";
    }

    protected function getAction()
    {
        return 'productFamily';
    }
}