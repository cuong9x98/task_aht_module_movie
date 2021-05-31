<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Movie\Model\Movie;

use AHT\Movie\Model\MovieFactory;
use AHT\Movie\Model\ResourceModel\Movie\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    protected $movieFactory;

    protected $productRepository;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    protected $_storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $colectionFactory,
        DataPersistorInterface $dataPersistor,
        MovieFactory $movieFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $colectionFactory->create();
        $this->movieFactory = $movieFactory;
        $this->productRepository = $productRepository;
        $this->dataPersistor = $dataPersistor;
        $this->_storeManager =  $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $block) {
            $this->loadedData[$block->getMovie_id()] = $block->getData();
        }

        $data = $this->dataPersistor->get('magenest_movie');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getMovie_id()] = $block->getData();
            $this->dataPersistor->clear('magenest_movie');
        }
        return $this->loadedData;
    }
}
