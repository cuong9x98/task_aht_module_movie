<?php
namespace AHT\Movie\Block\MiniCart;

use Magento\Catalog\Api\ProductRepositoryInterface;

class DefaultItem extends \Magento\Checkout\CustomerData\DefaultItem
{
    private $productRepository; 

    public function __construct(
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Msrp\Helper\Data $msrpHelper,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Catalog\Helper\Product\ConfigurationPool $configurationPool,
        \Magento\Checkout\Helper\Data $checkoutHelper,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ){
        parent::__construct($imageHelper, $msrpHelper, $urlBuilder, $configurationPool, $checkoutHelper);
        $this->productRepository = $productRepository;
    }
   
    protected function doGetItemData()
    {
        $child = $this->productRepository->get($this->item->getProduct()->getSku());
        $imageHelper = $this->imageHelper->init($child, 'mini_cart_product_thumbnail');
        $name = $child->getName();
        return [
            'options' => $this->getOptionList(),
            'qty' => $this->item->getQty() * 1,
            'item_id' => $this->item->getId(),
            'configure_url' => $this->getConfigureUrl(),
            'is_visible_in_site_visibility' => $this->item->getProduct()->isVisibleInSiteVisibility(),
            'product_id' => $this->item->getProduct()->getId(),
            'product_name' => $name, //Add you logic here for product name
            'product_sku' => $this->item->getProduct()->getSku(),
            'product_url' => $this->getProductUrl(),
            'product_has_url' => $this->hasProductUrl(),
            'product_price' => $this->checkoutHelper->formatPrice($this->item->getCalculationPrice()),
            'product_price_value' => $this->item->getCalculationPrice(),
            'product_image' => [
                'src' => $imageHelper->getUrl(),
                'alt' => $imageHelper->getLabel(),
                'width' => $imageHelper->getWidth(),
                'height' => $imageHelper->getHeight(),
            ],
            'canApplyMsrp' => $this->msrpHelper->isShowBeforeOrderConfirm($this->item->getProduct())
                && $this->msrpHelper->isMinimalPriceLessMsrp($this->item->getProduct()),
        ];
    }
}