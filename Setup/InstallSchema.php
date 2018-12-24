<?php
/**
 * Created by PhpStorm.
 * User: rav
 * Date: 2018-12-24
 * Time: 12:33
 */
namespace RedChamps\TemporaryAdminAccounts\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $installer->getConnection()->addColumn(
            $installer->getTable('admin_user'),
            'valid_till',
            Table::TYPE_DATE
        );

        $installer->endSetup();
    }
}