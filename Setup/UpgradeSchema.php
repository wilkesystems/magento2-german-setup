<?php
/**
 * Copyright © 2018 Magento. All rights reserved..
 * See LICENSE.md bundled with this module for license details.
 */
namespace WilkeSystems\MageGermanSetup\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class UpgradeSchema
 *
 * @package WilkeSystems\MageGermanSetup\Setup
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '2.0.1', '<')) {

            $setup->getConnection()->addColumn(
                $setup->getTable('catalog_eav_attribute'),
                'is_visible_on_checkout',
                [
                    'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    'unsigned' => true,
                    'nullable' => false,
                    'default'  => '0',
                    'comment'  => 'Is Visible On Checkout'
                ]
            );

        }

        $setup->endSetup();
    }
}
