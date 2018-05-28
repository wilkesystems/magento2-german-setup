<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Model\Setup\SubProcessor;

use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\ObjectManager\TMap;
use Magento\Framework\ObjectManager\TMapFactory;
use Traversable;

/**
 * Class SubProcessorPool
 *
 * @package WilkeSystems\MageGermanSetup\Model\Setup\SubProcessor
 */
class SubProcessorPool
{
    /**
     * @var SubProcessorInterface[] | TMap
     */
    private $subProcessors = [];

    /**
     * @param array       $subProcessors
     * @param TMapFactory $tmapFactory
     */
    public function __construct(
        TMapFactory $tmapFactory,
        array $subProcessors
    ) {
        $this->subProcessors = $tmapFactory->create(
            [
                'array' => $subProcessors,
                'type'  => SubProcessorInterface::class
            ]
        );
    }

    /**
     * Retrieves operation
     *
     * @param string $subProcessorCode
     * @return SubProcessorInterface
     * @throws NotFoundException
     */
    public function get($subProcessorCode)
    {
        if (!isset($this->subProcessors[$subProcessorCode])) {
            throw new NotFoundException(__('SubProcessor %1 does not exist.', $subProcessorCode));
        }

        return $this->subProcessors[$subProcessorCode];
    }

    /**
     * Retrieve the subprocessor codes
     *
     * @return array
     */
    public function getSubProcessorCodes()
    {
        $codes = [];
        foreach ($this->subProcessors->getIterator() as $code => $object) {
            $codes[] = $code;
        }

        return $codes;
    }
}
