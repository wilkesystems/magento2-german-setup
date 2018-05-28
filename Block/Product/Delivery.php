<?php
/**
 * Copyright © 2018 Magento. All rights reserved.
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Block\Product;

class Delivery extends \Magento\Catalog\Block\Product\View\Description
{
    /**
     * Retrieve current product object
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        return $this->getData('product');;
    }
}
