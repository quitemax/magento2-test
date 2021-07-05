<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Logger;

use Magento\Framework\Logger\Handler\Base;

/**
 * Module logger handler
 */
class Handler extends Base
{
    /**
     * @var string
     */
    protected $fileName = 'var/log/sohi/forecast.log';

    /**
     * @var bool
     */
    protected $bubble = false;
}
