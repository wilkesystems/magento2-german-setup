<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Model;

use Magento\Framework\Config\CacheInterface;
use WilkeSystems\MageGermanSetup\Model\Config\Reader;

/**
 * Class Config
 *
 * @package WilkeSystems\MageGermanSetup\Model
 */
class Config implements ConfigInterface
{
    /**
     * Configuration reader
     *
     * @var \Magento\Framework\Config\ReaderInterface
     */
    private $reader;

    /**
     * Configuration cache
     *
     * @var \Magento\Framework\Config\CacheInterface
     */
    private $cache;

    /**
     * @var string
     */
    private $country;

    /**
     * @var array
     */
    private $loadedConfig;

    /**
     * @param Reader         $reader
     * @param CacheInterface $cache
     * @param string         $country
     */
    public function __construct(
        Reader $reader,
        CacheInterface $cache,
        $country
    )
    {
        $this->reader = $reader;
        $this->cache = $cache;
        $this->country = $country;

        $this->initialize();
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return array
     */
    public function getAllowedCountries()
    {
        $countries = array_keys($this->loadedConfig);

        // remove the default country
        $key = array_search('default', $countries);
        if (false !== $key) {
            unset($countries[$key]);
        }

        return $countries;
    }

    /**
     * @return array
     */
    public function getSystemConfig()
    {
        $countrySystemConfig = [];
        if (isset($this->loadedConfig[$this->getCountry()]['system_config'])) {
            $countrySystemConfig = $this->loadedConfig[$this->getCountry()]['system_config'];
        }

        return array_merge($this->loadedConfig[self::DEFAULT_NODE]['system_config'], $countrySystemConfig);
    }

    /**
     * @return array|bool
     */
    public function getTaxClasses()
    {
        if (isset($this->loadedConfig[$this->getCountry()]['tax']['tax_classes'])) {
            return $this->loadedConfig[$this->getCountry()]['tax']['tax_classes'];
        }

        return false;
    }

    /**
     * @return array|bool
     */
    public function getTaxCalculationRates()
    {
        if (isset($this->loadedConfig[$this->getCountry()]['tax']['tax_calculation_rates'])) {
            return $this->loadedConfig[$this->getCountry()]['tax']['tax_calculation_rates'];
        }

        return false;
    }

    /**
     * @return array|bool
     */
    public function getTaxCalculationRules()
    {
        if (isset($this->loadedConfig[$this->getCountry()]['tax']['tax_calculation_rules'])) {
            return $this->loadedConfig[$this->getCountry()]['tax']['tax_calculation_rules'];
        }

        return false;
    }

    /**
     * @return array|bool
     */
    public function getAgreements()
    {
        if (isset($this->loadedConfig[$this->getCountry()]['agreements'])) {
            return $this->loadedConfig[$this->getCountry()]['agreements'];
        }

        return false;
    }

    /**
     * @return array|bool
     */
    public function getCmsPages()
    {
        if (isset($this->loadedConfig[$this->getCountry()]['pages'])) {
            return $this->loadedConfig[$this->getCountry()]['pages'];
        }

        return false;
    }

    /**
     * @return array|bool
     */
    public function getCmsBlocks()
    {
        if (isset($this->loadedConfig[$this->getCountry()]['blocks'])) {
            return $this->loadedConfig[$this->getCountry()]['blocks'];
        }

        return false;
    }

    /**
     * Initialize the configuration
     */
    private function initialize()
    {
        $data = $this->reader->read();
        $this->loadedConfig = $data;
    }
}
