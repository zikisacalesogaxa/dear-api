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

namespace Scout\Dear\Test;

use PHPUnit\Framework\TestCase;
use Scout\Dear\Config;

class ConfigTest extends TestCase
{
    public function testConfig()
    {
        $config = new Config('1111-2222', 'HELLO-WORLD');
        $this->assertInstanceOf(Config::class, $config);
    }
}