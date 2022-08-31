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

use Cale\Dear\Api\Contracts\DeleteMethodAllowed as DeleteContract;
use Cale\Dear\Api\Contracts\PostMethodAllowed as PostContract;
use Cale\Dear\Api\Contracts\PutMethodAllowed as PutContract;

class Journal extends BaseApi implements PostContract, PutContract, DeleteContract
{
    protected function getGUID()
    {
        return "ID";
    }

    protected function getAction()
    {
        return 'journal';
    }
}