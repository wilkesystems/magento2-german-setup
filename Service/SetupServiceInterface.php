<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Service;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface SetupServiceInterface
 *
 * @package WilkeSystems\MageGermanSetup\Service
 */
interface SetupServiceInterface
{
    /**
     * @return void
     */
    public function execute();

    /**
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output);
}
