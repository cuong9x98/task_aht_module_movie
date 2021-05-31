<?php 

namespace AHT\Movie\Controller\Adminhtml\Movie;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Create extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    
    const ADMIN_RESOURCE = "AHT_Movie::movie";
    
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('AHT_Movie::index');
        $resultPage->addBreadcrumb(__('Movie'), __('Movie'));
        $resultPage->addBreadcrumb(__('Manage Movie'), __('Manage Movie'));
        $resultPage->getConfig()->getTitle()->prepend(__('Movie'));
        return $resultPage;
    } 

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AHT_Movie::movie');
    }
}