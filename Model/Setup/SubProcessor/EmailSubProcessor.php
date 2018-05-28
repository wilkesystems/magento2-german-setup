<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Model\Setup\SubProcessor;

use WilkeSystems\MageGermanSetup\Model\Config;
use Magento\Framework\App\Config\Storage\WriterInterface;

/**
 * Class EmailSubProcessor
 *
 * @package WilkeSystems\MageGermanSetup\Model\Setup\SubProcessor
 */
class EmailSubProcessor extends AbstractSubProcessor
{
    /**
     * @param WriterInterface $configWriter
     */
    public function __construct(WriterInterface $configWriter)
    {
        parent::__construct($configWriter);
    }

    /**
     * @param Config $config
     * @return void
     */
    public function process(Config $config)
    {
        // TODO: Implement
    }
}
