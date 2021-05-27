<?php
namespace AHT\Movie\Model\ResourceModel\Actor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'actor_id';
	protected $_eventPrefix = 'magenest_actor_collection';
	protected $_eventObject = 'Actor_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('AHT\Movie\Model\Actor', 'AHT\Movie\Model\ResourceModel\Actor');
	}
}