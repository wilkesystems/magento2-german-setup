<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Plugin\Email\Block\Adminhtml\Template\Edit;

use WilkeSystems\MageGermanSetup\Plugin\Email\Model\Source\Variables;

/**
 * Class Variables
 *
 * @package WilkeSystems\MageGermanSetup\Plugin\Email\Block\Adminhtml\Template\Edit
 */
class Form
{
    /**
     * Additional config variables
     *
     * @var \WilkeSystems\MageGermanSetup\Plugin\Email\Model\Source\Variables
     */
    private $variables;

    /**
     * Constructor
     */
    public function __construct(\WilkeSystems\MageGermanSetup\Plugin\Email\Model\Source\Variables $variables)
    {
        $this->variables = $variables;
    }

    /**
     * Retrieve variables to insert into email
     *
     * @param \Magento\Email\Block\Adminhtml\Template\Edit\Form $subject
     * @param array $result
     *
     * @return array
     */
    public function afterGetVariables(\Magento\Email\Block\Adminhtml\Template\Edit\Form $subject, $result)
    {
        $additionalConfigValues = $this->variables->getAdditionalConfigVariables();
        $optionArray = [];
        foreach ($additionalConfigValues as $variable) {
            $optionArray[] = [
                'value' => '{{config path="' . $variable['value'] . '"}}',
                'label' => $variable['label'],
            ];
        }
        if ($optionArray) {
            $result[] = [
                'label' => __('Imprint'),
                'value' => $optionArray,
            ];
        }
        return $result;
    }
}
