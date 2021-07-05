<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Model;

use Exception;
use Sohi\Test\Api\Data\ForecastInterface;
use Sohi\Test\Api\Data\ForecastInterfaceFactory;
use Sohi\Test\Api\Data\ForecastSearchResultsInterface;
use Sohi\Test\Api\Data\ForecastSearchResultsInterfaceFactory;
use Sohi\Test\Api\ForecastRepositoryInterface;
use Sohi\Test\Logger\Logger;
use Sohi\Test\Model\ResourceModel\Forecast as ForecastResource;
use Sohi\Test\Model\ResourceModel\Forecast\Collection as ForecastCollection;
use Sohi\Test\Model\ResourceModel\Forecast\CollectionFactory as ForecastCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Forecast Repository for dealing with Forecasts
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ForecastRepository implements ForecastRepositoryInterface
{
    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * @var ForecastResource
     */
    private ForecastResource $forecastResource;

    /**
     * @var ForecastInterfaceFactory
     */
    private ForecastInterfaceFactory $forecastFactory;

    /**
     * @var ForecastSearchResultsInterfaceFactory
     */
    private ForecastSearchResultsInterfaceFactory $forecastSearchResultsFactory;

    /**
     * @var ForecastCollectionFactory
     */
    private ForecastCollectionFactory $forecastCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @var array
     */
    private $forecastById = [];

    /**
     * @param Logger $logger
     * @param ForecastResource $forecastResource
     * @param ForecastInterfaceFactory $forecastFactory
     * @param ForecastSearchResultsInterfaceFactory $forecastSearchResultsFactory
     * @param ForecastCollectionFactory $forecastCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        Logger $logger,
        ForecastResource $forecastResource,
        ForecastInterfaceFactory $forecastFactory,
        ForecastSearchResultsInterfaceFactory $forecastSearchResultsFactory,
        ForecastCollectionFactory $forecastCollectionFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->logger = $logger;
        $this->forecastResource = $forecastResource;
        $this->forecastFactory = $forecastFactory;
        $this->forecastSearchResultsFactory = $forecastSearchResultsFactory;
        $this->forecastCollectionFactory = $forecastCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(ForecastInterface $forecast): ForecastInterface
    {
        try {
            $this->forecastResource->save($forecast);
        } catch (Exception $e) {
            $this->logger->critical($e);
            throw new CouldNotSaveException(__('Could not save the forecast.'));
        }

        return $forecast;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $forecastId): ForecastInterface
    {
        if (isset($this->forecastById[$forecastId])) {
            return $this->forecastById[$forecastId];
        }

        /** @var ForecastInterface $forecast */
        $forecast = $this->forecastFactory->create();
        $this->forecastResource->load($forecast, $forecastId);

        if (!$forecast->getForecastId()) {
            throw new NoSuchEntityException(__('Forecast with the %1 ID does not exist.', $forecastId));
        }

        $this->forecastById[$forecastId] = $forecast;

        return $forecast;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ForecastSearchResultsInterface
    {
        /** @var ForecastSearchResultsInterface $searchResults */
        $searchResults = $this->forecastSearchResultsFactory->create();
        /** @var ForecastCollection $collection */
        $collection = $this->forecastCollectionFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ForecastInterface $forecast): void
    {
        try {
            $this->forecastResource->delete($forecast);
        } catch (Exception $e) {
            $this->logger->critical($e);
            throw new CouldNotDeleteException(__('Could not delete the forecast'));
        }

        unset($this->forecastById[$forecast->getForecastId()]);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById(int $forecastId): void
    {
        $forecast = $this->getById($forecastId);
        $this->delete($forecast);
    }
}
