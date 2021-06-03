<?php
namespace AHT\Movie\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_customerSession;
    protected $_type;
    protected $_fullModuleList;
    protected $_session;
    protected $_orderFactory;
    protected $_customer;

    protected $resourceConnection;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \AHT\Attribute\Model\Source\Type $type,
        \Magento\Framework\Module\FullModuleList $fullModuleList,
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Customer\Model\Session $session,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,

        \Magento\Sales\Model\Order\InvoiceRepositoryFactory $invoiceRepositoryFactory,
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria,

        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
        $this->_customerSession = $customerSession;
        $this->_type = $type;
        $this->_fullModuleList = $fullModuleList;
        $this->_session = $session;
        $this->_orderFactory = $orderFactory;
        $this->_customerFactory = $customerFactory;

        $this->invoiceRepositoryFactory = $invoiceRepositoryFactory;
        $this->searchCriteria = $searchCriteria;

        $this->resourceConnection = $resourceConnection;
    }
    // Get All Module
    public function getAllModel()
    {
        return $this->_fullModuleList->getAll();
    }

    // Get Order
    public function getLabel()
    {
        $count = count($this->getOrders());
        return $count;
    }

    public function getOrders()
    {
        $this->orders = $this->_orderFactory->create()->getCollection();
        return $this->orders;
    }

     // Get Customer
     public function getLabelCustomer()
     {
         $count = count($this->getCustomer());
         return $count;
     }
 
     public function getCustomer()
     {
         $this->customer = $this->_customerFactory->create()->getCollection();
         return $this->customer;
     }
     //
     public function getInvoices()
     {
        $this->searchCriteria->setFilterGroups();
        $invoiceRepo = $this->invoiceRepositoryFactory->create();
        $invoiceRepoCollection = $invoiceRepo->getList($this->searchCriteria);
        $items = $invoiceRepoCollection->getItems();
        return ($invoiceRepoCollection->getSize());
     }
     // creditmemoCollection
   
    // Get Product
    // Get module 
    public function runSqlQuery($name)
    {
        $connection = $this->resourceConnection->getConnection();
        // $table is table name
        $table = $connection->getTableName($name);
        //For Select query
        $query = "Select COUNT(*) FROM " . $table;
        
        $result = $connection->fetchAll($query);
        
        return $result[0]['COUNT(*)'];
    }

}