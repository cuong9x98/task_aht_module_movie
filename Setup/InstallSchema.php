<?php

namespace AHT\Movie\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('magenest_director')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_director')
            )
                ->addColumn(
                    'director_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Movie Id'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Name'
                );
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('magenest_director'),
                $setup->getIdxName(
                    $installer->getTable('magenest_director'),
                    ['name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        if (!$installer->tableExists('magenest_actor')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_actor')
            )
                ->addColumn(
                    'actor_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Actor Id'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Name'
                );
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('magenest_actor'),
                $setup->getIdxName(
                    $installer->getTable('magenest_actor'),
                    ['name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        if (!$installer->tableExists('magenest_movie')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie')
            )
                ->addColumn(
                    'movie_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Movie Id'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Name'
                )
                ->addColumn(
                    'description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Description'
                )
                ->addColumn(
                    'rating',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['nullable' =>false, 'default' => '0'],
                    'Rating'
                )
                ->addColumn(
                    'director_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable'=>true,
                        'unsigned'=>true
                    ],
                    'Director Id'
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'magenest_movie',
                        'director_id',
                        'magenest_director',
                        'director_id'
                    ),
                    'director_id',
                    $installer->getTable('magenest_director'),
                    'director_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                );
            $installer->getConnection()->createTable($table);
        }
        if (!$installer->tableExists('magenest_movie_actor')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie_actor')
            )
                ->addColumn(
                    'movie_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable'=>true,
                        'unsigned'=>true
                    ],
                    'Movie Id'
                )
                ->addColumn(
                    'actor_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable'=>true,
                        'unsigned'=>true
                    ],
                    'Actor Id'
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'magenest_movie_actor',
                        'movie_id',
                        'magenest_movie',
                        'movie_id'
                    ),
                    'movie_id',
                    $installer->getTable('magenest_movie'),
                    'movie_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'magenest_movie_actor',
                        'actor_id',
                        'magenest_actor',
                        'actor_id'
                    ),
                    'actor_id',
                    $installer->getTable('magenest_actor'),
                    'actor_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
