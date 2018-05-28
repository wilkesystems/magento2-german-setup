<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Model\Setup\SubProcessor;

use WilkeSystems\MageGermanSetup\Model\Config;
use Magento\Framework\App\Config\Storage\WriterInterface;

/**
 * Class AgreementsSubProcessor
 *
 * @package WilkeSystems\MageGermanSetup\Model\Setup\SubProcessor
 */
class AgreementsSubProcessor extends AbstractSubProcessor
{
    /**
     * @var \WilkeSystems\MageGermanSetup\Model\Config
     */
    private $config;

    /**
     * @var \Magento\Framework\Module\Dir\Reader
     */
    private $moduleReader;

    /**
     * @var \Magento\CheckoutAgreements\Model\AgreementFactory
     */
    private $agreementFactory;

    /**
     * @var \Magento\CheckoutAgreements\Model\CheckoutAgreementsRepository
     */
    private $agreementsRepository;

    /**
     * @param WriterInterface                                                $configWriter
     * @param \Magento\Framework\Module\Dir\Reader                           $moduleReader
     * @param \Magento\CheckoutAgreements\Model\AgreementFactory             $agreementFactory
     * @param \Magento\CheckoutAgreements\Model\CheckoutAgreementsRepository $agreementsRepository
     */
    public function __construct(
        WriterInterface $configWriter,
        \Magento\Framework\Module\Dir\Reader $moduleReader,
        \Magento\CheckoutAgreements\Model\AgreementFactory $agreementFactory,
        \Magento\CheckoutAgreements\Model\CheckoutAgreementsRepository $agreementsRepository
    ) {
        $this->moduleReader = $moduleReader;
        $this->agreementFactory = $agreementFactory;
        $this->agreementsRepository = $agreementsRepository;
        parent::__construct($configWriter);
    }

    /**
     * @param Config $config
     * @return void
     */
    public function process(Config $config)
    {
        $this->config = $config;

        // Load agreements
        $agreementsConfig = $config->getAgreements();
        if (!$agreementsConfig) {
            return;
        }

        foreach ($agreementsConfig as $agreementData) {
            // Check if template filename exists
            $filename = $agreementData['filename'];
            $template = $this->getTemplatePath() . $filename;
            if (!file_exists($template)) {
                continue;
            }

            // Remove filename from data
            unset($agreementData['filename']);

            // Fetch template content
            $templateContent = @file_get_contents($template);

            // Fetch agreement name
            $name = '';
            if (preg_match('/<!--@name\s*(.*?)\s*@-->/u', $templateContent, $matches)) {
                $name = trim($matches[1]);
                $templateContent = str_replace($matches[0], '', $templateContent);
            }

            // Fetch checkbox text
            $checkboxText = '';
            if (preg_match('/<!--@checkbox_text\s*(.*?)\s*@-->/u', $templateContent, $matches)) {
                $checkboxText = trim($matches[1]);
                $templateContent = str_replace($matches[0], '', $templateContent);
            }

            // Fetch agreement content
            $content = preg_replace('#\{\*.*\*\}#suU', '', $templateContent);
            $content = trim($content);

            // Create agreement
            /** @var \Magento\CheckoutAgreements\Model\Agreement $agreement */
            $agreement = $this->agreementFactory->create();
            $agreement = $agreement->setStoreId(0)->load($name, 'name');
            if (!$agreement->getId()) {
                $agreement = $this->agreementFactory->create();
            }

            $agreement->addData($agreementData);
            $agreement->setCheckboxText($checkboxText);
            $agreement->setName($name);
            $agreement->setContent($content);
            $agreement->setStores([0]);

            $this->agreementsRepository->save($agreement);
        }

        $this->saveConfigValue('checkout/options/enable_agreements', 1);
    }

    /**
     * @return string
     */
    private function getTemplatePath()
    {
        $path = $this->moduleReader->getModuleDir(
            \Magento\Framework\Module\Dir::MODULE_I18N_DIR,
            'WilkeSystems_MageGermanSetup'
        );

        $path .= DIRECTORY_SEPARATOR . 'template';
        $path .= DIRECTORY_SEPARATOR . $this->config->getCountry();
        $path .= DIRECTORY_SEPARATOR . 'agreements';
        $path .= DIRECTORY_SEPARATOR;

        return $path;
    }
}
