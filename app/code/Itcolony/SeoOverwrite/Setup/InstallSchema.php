<?php
namespace Itcolony\SeoOverwrite\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $table = $setup->getConnection()->newTable(
            $setup->getTable('seo_data')
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Entity Id'
        )->addColumn(
            'url',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Address Url'
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            '64k',
            ['nullable' => false],
            'Meta Title'
        )->addColumn(
            'description',
            Table::TYPE_TEXT,
            '64k',
            ['nullable' => false],
            'Meta Description'
        )->addColumn(
            'robots',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Meta Robots'
        )->addColumn(
            'keywords',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Keywords'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' =>Table::TIMESTAMP_INIT],
            'Created At'
        )->addColumn(
            'updated_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
            'Updated At'
        )->addIndex($setup->getIdxName('seo_metadata', ['url'],
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE), ['url'],
            [      'type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )->setComment(
            'SEO Table for Meta Data'
        );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }

}

?>