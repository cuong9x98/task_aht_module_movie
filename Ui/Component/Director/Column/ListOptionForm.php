<?php
namespace AHT\Movie\Ui\Component\Director\Column;

use AHT\Movie\Model\ResourceModel\Director\Grid\CollectionFactory;

class ListOptionForm implements \Magento\Framework\Option\ArrayInterface            
{
    protected $_categoryFactory;
    protected $_loadedData; 

    public function __construct(
        CollectionFactory $directorCollectionFactory
    ){
        $this->_directorFactory = $directorCollectionFactory->create();
        // die;
    }
 
    public function toOptionArray()
    { 
        $directors = $this->_directorFactory->getItems();
        $optionArray = [];
        foreach($directors as $director){
            $director = $director->getData();
            array_push($optionArray,[
                'value'  => $director['director_id'],
                'label'  => $director['name'],
            ]);
        }
    return $optionArray;
    }
}