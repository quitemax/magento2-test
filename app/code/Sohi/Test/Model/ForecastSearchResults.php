<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Model;

use Sohi\Test\Api\Data\ForecastSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Forecast search results.
 */
class ForecastSearchResults extends SearchResults implements ForecastSearchResultsInterface
{
}
