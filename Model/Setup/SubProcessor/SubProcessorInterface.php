<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Model\Setup\SubProcessor;

use WilkeSystems\MageGermanSetup\Model\Config;

/**
 * Interface SubProcessorInterface
 *
 * @package Seat\IntegrationKM\Model\Product\SubProcessor
 */
interface SubProcessorInterface
{
    /**
     * @param Config $config
     * @return void
     */
    public function process(Config $config);
}
