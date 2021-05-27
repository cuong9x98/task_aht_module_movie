<?php

namespace AHT\Movie\Block\Movie;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use AHT\Movie\Model\ResourceModel\Movie\CollectionFactory;

class ListMovie extends Template 
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

    public function getListMovie()
    {
        // return $this->collection->create();
        $collection =  $this->collection->create();

        $collection->getSelect()->join(
            ['magenest_director' =>$collection->getTable("magenest_director")],
            'main_table.director_id=magenest_director.director_id',
            ['auth'=>'magenest_director.name']
        );

        return $collection;

    }
    public function getListDirector()
    {
        return $this->director->create();
    }
    public function getListActor()
    {
        return $this->actor->create();
    }

   
}