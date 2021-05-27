<?php
namespace AHT\Movie\Model\ResourceModel\Director;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'director_id';
	protected $_eventPrefix = 'magenest_director_collection';
	protected $_eventObject = 'Director_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('AHT\Movie\Model\Director', 'AHT\Movie\Model\ResourceModel\Director');
	}

}