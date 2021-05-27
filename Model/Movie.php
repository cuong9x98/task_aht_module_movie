<?php
namespace AHT\Movie\Model;

use \Magento\Framework\DataObject\IdentityInterface;

class Movie extends \Magento\Framework\Model\AbstractModel 
{

    /**
     * Undocumented function
     *
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,  
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource=null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection=null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
    /**
     * @return void
     */
    
	public function _construct()
	{
		$this->_init('AHT\Movie\Model\ResourceModel\Movie');
    }
       /**
     * Undocumented function
     *
     * @return string
     */
    public function getMovie_id() {
        return $this->getData("movie_id");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName() {
        return $this->getData("name");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getDescription() {
        return $this->getData("description");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getRating() {
        return $this->getData("rating");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getDirector_id() {
        return $this->getData("director_id");
    }
    
    public function setMovie_id($id)
    {
        $this->setData('movie_id', $id);
    }
    /**
     * Undocumented function
     *
     * @param int
     * @return null
     */
    public function setName($name) {
        return $this->setData("name", $name);
    }
    /**
     * Undocumented function
     *
     * @param int
     * @return null
     */
    public function setDescription($description) {
        return $this->setData("description", $description);
    }
    /**
     * Undocumented function
     *
     * @param string $email
     * @return null
     */
    public function setRating($rating) {
        return $this->setData("rating", $rating);
    }
    /**
     * Undocumented function
     *
     * @param string $director_id
     * @return null
     */
    public function setDirector_id($director_id) {
        return $this->setData("director_id", $director_id);

    }
}