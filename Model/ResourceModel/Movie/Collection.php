<?php
namespace AHT\Movie\Model\ResourceModel\Movie;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'movie_id';
	protected $_eventPrefix = 'magenest_movie_collection';
	protected $_eventObject = 'Movie_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('AHT\Movie\Model\Movie', 'AHT\Movie\Model\ResourceModel\Movie');
	}

}