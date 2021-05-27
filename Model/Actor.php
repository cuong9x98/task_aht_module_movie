<?php
namespace AHT\Movie\Model;

use \Magento\Framework\DataObject\IdentityInterface;

class Actor extends \Magento\Framework\Model\AbstractModel 
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
		$this->_init('AHT\Movie\Model\ResourceModel\Actor');
    }
       /**
     * Undocumented function
     *
     * @return string
     */
    public function getActor_id() {
        return $this->getData("actor_id");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName() {
        return $this->getData("name");
    }

    public function setActor_id($id)
    {
        $this->setData('actor_id', $id);
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
   
}