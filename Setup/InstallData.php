<?php

/**
 * Copyright © 2016 Magento. All rights reserved. * See COPYING.txt for license details.
 */

namespace AHT\Movie\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */

class InstallData implements InstallDataInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // data table magenest_director
        $data = [
            ['name'         => "Cuong"],
        ];
        foreach ($data as $bind) {
            $setup->getConnection()
                ->insertForce($setup->getTable('magenest_director'), $bind);
        }
        // data table  magenest_actor
        $data1 = [
            ['name'         => "Thinh"],
        ];
        foreach ($data1 as $bind) {
            $setup->getConnection()
                ->insertForce($setup->getTable('magenest_actor'), $bind);
        }
        // data table magenest_movie
        $data2 = [
            ['name'         => "All Star",
             'description'         => "5 ae sieu nhan",
              'rating'         => 5,
              'director_id'         => 1],
        ];
        foreach ($data2 as $bind) {
            $setup->getConnection()
                ->insertForce($setup->getTable('magenest_movie'), $bind);
        }
        // data table  magenest_movie_actor
        $data3 = [
            ['movie_id'         => 1],
            ['actor_id'         => 1]
        ];
        foreach ($data3 as $bind) {
            $setup->getConnection()
                ->insertForce($setup->getTable('magenest_movie_actor'), $bind);
        }
    }
}
