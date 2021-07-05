<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

namespace Sohi\Test\ViewModel;

use Exception;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Sohi\Test\Api\ForecastRepositoryInterface;
use Sohi\Test\Logger\Logger;

/**
 * Class Forecast
 */
class Forecast implements ArgumentInterface
{
    /**
     * @var ForecastRepositoryInterface
     */
    private ForecastRepositoryInterface $forecastRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $builder;

    /**
     * @var SortOrderBuilder
     */
    private SortOrderBuilder $sortOrderBuilder;

    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * @var
     */
    private $forecast;

    public function __construct(
        ForecastRepositoryInterface $forecastRepository,
        SearchCriteriaBuilder $builder,
        SortOrderBuilder $sortOrderBuilder,
        Logger $logger
    ) {
        $this->forecastRepository = $forecastRepository;
        $this->builder = $builder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Lublin Forecast';
    }

    /**
     * @return null|\Sohi\Test\Api\Data\ForecastInterface
     */
    public function getForecast()
    {
        if (!$this->forecast) {
            try {
                $searchCriteria = $this->builder->create();
                $sortOrder = $this->sortOrderBuilder->create();
                $sortOrder
                    ->setField("forecast_id")
                    ->setDirection("DESC");

                $searchCriteria->setSortOrders([$sortOrder]);
                $searchCriteria->setPageSize(1);
                $searchCriteria->setCurrentPage(1);

                $forecastResults = $this->forecastRepository->getList($searchCriteria)->getItems();

                if (count($forecastResults)) {
                    $this->forecast = array_pop($forecastResults);
                }
            } catch (Exception $e) {
                $this->logger->critical($e->getMessage());
            }
        }

        return $this->forecast;
    }
}
