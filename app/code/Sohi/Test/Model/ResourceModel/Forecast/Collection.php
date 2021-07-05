<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Model\ResourceModel\Forecast;

use Sohi\Test\Model\Forecast;
use Sohi\Test\Model\ResourceModel\Forecast as ForecastResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Forecast collection
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(Forecast::class, ForecastResource::class);
        $this->_setIdFieldName('forecast_id');
    }
}
