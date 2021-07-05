<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Api;

/**
 * Interface for Forecast repository
 */
interface ForecastRepositoryInterface
{
    /**
     * Save forecast
     * @param \Sohi\Test\Api\Data\ForecastInterface $forecast
     * @return \Sohi\Test\Api\Data\ForecastInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function save(
        \Sohi\Test\Api\Data\ForecastInterface $forecast
    ): \Sohi\Test\Api\Data\ForecastInterface;

    /**
     * Retrieve forecast by ID
     * @param int $forecastId
     * @return \Sohi\Test\Api\Data\ForecastInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function getById(int $forecastId): \Sohi\Test\Api\Data\ForecastInterface;

    /**
     * Retrieve forecast matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Sohi\Test\Api\Data\ForecastSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    ): \Sohi\Test\Api\Data\ForecastSearchResultsInterface;

    /**
     * Delete forecast
     * @param \Sohi\Test\Api\Data\ForecastInterface $forecast
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function delete(
        \Sohi\Test\Api\Data\ForecastInterface $forecast
    ): void;

    /**
     * Delete forecast by ID
     * @param int $forecastId
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function deleteById(int $forecastId): void;
}
