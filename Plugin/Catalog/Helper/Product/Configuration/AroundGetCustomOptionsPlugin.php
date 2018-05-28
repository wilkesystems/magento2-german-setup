<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Plugin\Catalog\Helper\Product\Configuration;

use \WilkeSystems\MageGermanSetup\Service\GetVisibleCheckoutAttributesServiceInterface;

/**
 * Class AroundGetCustomOptionsPlugin
 *
 * @package WilkeSystems\MageGermanSetup\Plugin\Catalog\Helper\Product\Configuration
 */
class AroundGetCustomOptionsPlugin
{
    /**
     * @var GetVisibleCheckoutAttributesServiceInterface
     */
    private $getVisibleCheckoutAttributesService;

    /**
     * AroundGetCustomOptionsPlugin constructor.
     *
     * @param GetVisibleCheckoutAttributesServiceInterface $getVisibleCheckoutAttributesService
     */
    public function __construct(GetVisibleCheckoutAttributesServiceInterface $getVisibleCheckoutAttributesService)
    {
        $this->getVisibleCheckoutAttributesService = $getVisibleCheckoutAttributesService;
    }

    /**
     * @param \Magento\Catalog\Helper\Product\Configuration                   $subject
     * @param \Closure                                                        $proceed
     * @param \Magento\Catalog\Model\Product\Configuration\Item\ItemInterface $item
     * @return array
     */
    public function aroundGetCustomOptions(
        \Magento\Catalog\Helper\Product\Configuration $subject,
        \Closure $proceed,
        \Magento\Catalog\Model\Product\Configuration\Item\ItemInterface $item
    )
    {
        $options = $proceed($item);

        $attributes = $this->getVisibleCheckoutAttributesService->execute();
        if (count($attributes) > 0) {
            foreach ($attributes as $attributeCode => $attribute) {
                $value = $attribute->getFrontend()->getValue($item->getProduct());
                if (!$value) {
                    continue;
                }

                $options[] = [
                    'label'       => $attribute->getStoreLabel(),
                    'value'       => $value,
                    'print_value' => $value
                ];
            }
        }

        return $options;
    }
}
