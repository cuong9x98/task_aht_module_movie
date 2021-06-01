<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Movie\Controller\Adminhtml\Movie;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use AHT\Movie\Model\ResourceModel\Movie as Resource;
use AHT\Movie\Model\Movie;
use AHT\Movie\Model\MovieFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

/**
 * Save CMS block action.
 */
class Save extends \AHT\Movie\Controller\Adminhtml\Block implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var BlockFactory
     */
    private $movieFactory;

    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;
    
    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     * @param BlockFactory|null $blockFactory
     * @param BlockRepositoryInterface|null $blockRepository
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        MovieFactory $movieFactory,
        Resource $resource
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->movieFactory = $movieFactory;
        $this->resource = $resource;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (empty($data['movie_id'])) {
                $data['movie_id'] = null;
            }

            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->movieFactory->create();

            $id = $this->getRequest()->getParam('movie_id');
            if ($id) {
                try {
                    $this->resource->load($model, $id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This block no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $model->setData($data);
            $name = $this->getRequest()->getParam('name');
            try {
                if($name=="Ping"){
                    $model->setName('Pong');
                }
                $model->setRating(0);
                $this->resource->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the block.'));
                $this->dataPersistor->clear('magenest_director');
                return $this->processBlockReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the block.'));
            }

            $this->dataPersistor->set('magenest_director', $data);
            return $resultRedirect->setPath('*/*/fix', ['movie_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process and set the block return
     *
     * @param \Magento\Cms\Model\Block $model
     * @param array $data
     * @param \Magento\Framework\Controller\ResultInterface $resultRedirect
     * @return \Magento\Framework\Controller\ResultInterface
     */
    private function processBlockReturn($model, $data, $resultRedirect)
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            return $resultRedirect->setPath('*/*/');
        } else if ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        } 
        elseif ($redirect === 'next') {
            $resultRedirect->setPath('*/*/fix', ['movie_id' => $this->getIndex($data['movie_id'])]);
        }
        return $resultRedirect;
    }

    private function getIndex($id) {
        $collection = $this->movieFactory->create()->getCollection()->getAllIds();
        $index = array_search($id, $collection);
        $next = $index;
        $movie = $this->movieFactory->create();
        if($index == (count($collection)-1)) {
            $next = 0;
        }
        else {
            $next = $index + 1;
        }
        return $movie->load($collection[$next])->getId();
    }
}