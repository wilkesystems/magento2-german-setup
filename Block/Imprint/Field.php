<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Block\Imprint;

use Magento\Framework\View\Element\Template;

/**
 * Class Field
 *
 * @package WilkeSystems\MageGermanSetup\Block\Imprint
 */
class Field extends \WilkeSystems\MageGermanSetup\Block\Imprint\Content
{
    /**
     * Retrieve the system configuration value for the given field
     *
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->getField() == 'email') {
            return $this->getEmail(true);
        }

        return $this->getImprintValue($this->getField());
    }
}
