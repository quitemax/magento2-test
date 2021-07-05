<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for forecast search results
 */
interface ForecastSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return ForecastInterface[]
     */
    public function getItems();

    /**
     * @param ForecastInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
