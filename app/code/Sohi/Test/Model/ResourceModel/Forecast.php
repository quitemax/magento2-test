<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Forecast resource model
 */
class Forecast extends AbstractDb
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('sohi_test_forecast', 'forecast_id');
    }
}
