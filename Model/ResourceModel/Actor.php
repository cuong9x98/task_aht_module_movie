<?php
namespace AHT\Movie\Model\ResourceModel;

class Actor extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    protected function _construct() 
    {
        $this->_init('magenest_actor', 'actor_id');
    }
}