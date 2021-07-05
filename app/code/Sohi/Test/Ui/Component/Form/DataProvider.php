<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Ui\Component\Form;

use Sohi\Test\Enum\ForecastEnum;
use Sohi\Test\Model\ResourceModel\Forecast\Collection as ForecastCollection;
use Sohi\Test\Model\ResourceModel\Forecast\CollectionFactory as ForecastCollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

/**
 * Data Provider for Forecast form
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var ForecastCollection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var array
     */
    private $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ForecastCollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ForecastCollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $this->loadedData = [];

        $items = $this->collection->getItems();
        foreach ($items as $forecast) {
            $forecastData = $forecast->getData();
            $this->loadedData[$forecast->getForecastId()] = $forecastData;
        }

        $data = $this->dataPersistor->get(ForecastEnum::DATA_PERSISTOR_KEY);

        if (!empty($data)) {
            $forecast = $this->collection->getNewEmptyItem();
            $forecast->setData($data);
            $forecastId = $forecast->getForecastId() ?: '';
            $this->loadedData[$forecastId] = $forecast->getData();
            $this->dataPersistor->clear(ForecastEnum::DATA_PERSISTOR_KEY);
        }
        return $this->loadedData;
    }
}
