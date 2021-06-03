<?php
namespace AHT\Movie\Block\Report;

class Data extends \Magento\Framework\View\Element\Template
{
    protected $fullModuleList;

    public function __construct(
        \Magento\Framework\Module\FullModuleList $fullModuleList
    ) {

        $this->fullModuleList = $fullModuleList;
    }

    public function modulesList()
    {
        $allModules = $this->fullModuleList->getAll();
    }
}