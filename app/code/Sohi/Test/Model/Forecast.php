<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Model;

use Sohi\Test\Api\Data\ForecastInterface;
use Sohi\Test\Model\ResourceModel\Forecast as ForecastResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Forecast Data Model
 */
class Forecast extends AbstractModel implements ForecastInterface
{
    /**
     * @inheritDoc
     */
    public function _construct() //phpcs:ignore
    {
        $this->_init(ForecastResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getForecastId(): int
    {
        return (int)$this->getData(self::FORECAST_ID);
    }

    /**
     * @inheritDoc
     */
    public function setForecastId(int $id): ForecastInterface
    {
        return $this->setData(self::FORECAST_ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return (string)$this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title): ForecastInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return (string)$this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description): ForecastInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function getTemperature(): float
    {
        return (float)$this->getData(self::TEMPERATURE);
    }

    /**
     * @inheritDoc
     */
    public function setTemperature(float $temperature): ForecastInterface
    {
        return $this->setData(self::TEMPERATURE, $temperature);
    }

    /**
     * @inheritDoc
     */
    public function getFeelsLikeTemperature(): float
    {
        return (float)$this->getData(self::FEELS_LIKE_TEMPERATURE);
    }

    /**
     * @inheritDoc
     */
    public function setFeelsLikeTemperature(float $feelsLikeTemperature): ForecastInterface
    {
        return $this->setData(self::FEELS_LIKE_TEMPERATURE, $feelsLikeTemperature);
    }

    /**
     * @inheritDoc
     */
    public function getPressure(): float
    {
        return (float)$this->getData(self::PRESSURE);
    }

    /**
     * @inheritDoc
     */
    public function setPressure(float $pressure): ForecastInterface
    {
        return $this->setData(self::PRESSURE, $pressure);
    }

    /**
     * @inheritDoc
     */
    public function getHumidity(): int
    {
        return (int)$this->getData(self::HUMIDITY);
    }

    /**
     * @inheritDoc
     */
    public function setHumidity(int $humidity): ForecastInterface
    {
        return $this->setData(self::HUMIDITY, $humidity);
    }

    /**
     * @inheritDoc
     */
    public function getVisibility(): int
    {
        return (int)$this->getData(self::VISIBILITY);
    }

    /**
     * @inheritDoc
     */
    public function setVisibility(int $visibility): ForecastInterface
    {
        return $this->setData(self::VISIBILITY, $visibility);
    }

    /**
     * @inheritDoc
     */
    public function getWindSpeed(): float
    {
        return (float)$this->getData(self::WIND_SPEED);
    }

    /**
     * @inheritDoc
     */
    public function setWindSpeed(float $windSpeed): ForecastInterface
    {
        return $this->setData(self::WIND_SPEED, $windSpeed);
    }

    /**
     * @inheritDoc
     */
    public function getWindDirection(): int
    {
        return (int)$this->getData(self::WIND_DIRECTION);
    }

    /**
     * @inheritDoc
     */
    public function setWindDirection(int $windDirection): ForecastInterface
    {
        return $this->setData(self::WIND_DIRECTION, $windDirection);
    }

    /**
     * @inheritDoc
     */
    public function getCloudCover(): int
    {
        return (int)$this->getData(self::CLOUD_COVER);
    }

    /**
     * @inheritDoc
     */
    public function setCloudCover(int $cloudCover): ForecastInterface
    {
        return $this->setData(self::CLOUD_COVER, $cloudCover);
    }

    /**
     * @inheritDoc
     */
    public function getCreationTime(): ?string
    {
        return (string)$this->getData(self::CREATION_TIME) ?: null;
    }

    /**
     * @inheritDoc
     */
    public function setCreationTime(string $creationTime = null): ForecastInterface
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }
}
