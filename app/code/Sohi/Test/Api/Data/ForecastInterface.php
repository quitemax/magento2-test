<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Api\Data;

/**
 * Forecast data interface
 */
interface ForecastInterface
{
    /**#@+
     * Constants - sohi_test_forecast table available column names
     */
    public const FORECAST_ID = 'forecast_id';
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';
    public const TEMPERATURE = 'temp';
    public const FEELS_LIKE_TEMPERATURE = 'temp_feel';
    public const PRESSURE = 'pressure';
    public const HUMIDITY = 'humidity';
    public const VISIBILITY = 'visibility';
    public const WIND_SPEED = 'wind_spd';
    public const WIND_DIRECTION = 'wind_deg';
    public const CLOUD_COVER = 'clouds';
    public const CREATION_TIME = 'creation_time';
    /**#@-*/

    /**
     * @return int
     */
    public function getForecastId(): int;

    /**
     * @param int $id
     * @return $this
     */
    public function setForecastId(int $id): self;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self;

    /**
     * @return float
     */
    public function getTemperature(): float;

    /**
     * @param float $temperature
     * @return $this
     */
    public function setTemperature(float $temperature): self;

    /**
     * @return float
     */
    public function getFeelsLikeTemperature(): float;

    /**
     * @param float $feelsLikeTemperature
     * @return $this
     */
    public function setFeelsLikeTemperature(float $feelsLikeTemperature): self;

    /**
     * @return float
     */
    public function getPressure(): float;

    /**
     * @param float $pressure
     * @return $this
     */
    public function setPressure(float $pressure): self;

    /**
     * @return int
     */
    public function getHumidity(): int;

    /**
     * @param int $humidity
     * @return $this
     */
    public function setHumidity(int $humidity): self;

    /**
     * @return int
     */
    public function getVisibility(): int;

    /**
     * @param int $visibility
     * @return $this
     */
    public function setVisibility(int $visibility): self;

    /**
     * @return float
     */
    public function getWindSpeed(): float;

    /**
     * @param float $windSpeed
     * @return $this
     */
    public function setWindSpeed(float $windSpeed): self;

    /**
     * @return int
     */
    public function getWindDirection(): int;

    /**
     * @param int $windDirection
     * @return $this
     */
    public function setWindDirection(int $windDirection): self;

    /**
     * @return int
     */
    public function getCloudCover(): int;

    /**
     * @param int $cloudCover
     * @return $this
     */
    public function setCloudCover(int $cloudCover): self;

    /**
     * @return string|null
     */
    public function getCreationTime(): ?string;

    /**
     * @param string|null $creationTime
     * @return $this
     */
    public function setCreationTime(string $creationTime = null): self;
}
