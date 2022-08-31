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

class ProductAttachment extends BaseApi implements PostContract, DeleteContract
{
    protected function getGUID()
    {
        return "ID";
    }

    protected function getAction()
    {
        return 'product/attachments';
    }
}