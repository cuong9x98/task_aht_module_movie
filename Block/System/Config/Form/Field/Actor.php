<?php
namespace AHT\Movie\Block\System\Config\Form\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use AHT\Movie\Model\ResourceModel\Movie\CollectionFactory;

class Actor extends \Magento\Config\Block\System\Config\Form\Field
{    
    public $collection;
    public $director;
    public $actor;

    protected $namedirector;

    public function __construct(
        Context $context, 
        CollectionFactory $collectionFactory, 
        \AHT\Movie\Model\ResourceModel\Director\CollectionFactory $directorFactory,
        \AHT\Movie\Model\ResourceModel\Actor\CollectionFactory $actorFactory,
        array $data = [])
    {
        $this->actor = $actorFactory;
        $this->director = $directorFactory;
        $this->collection = $collectionFactory;
        parent::__construct($context, $data);
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        $actor =  $this->actor->create();
        $element->setDisabled('disabled');
        $element->setValue($actor->count());
        return $element->getElementHtml();
    }
}