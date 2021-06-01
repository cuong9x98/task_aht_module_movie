<?php
 
namespace AHT\Movie\Plugin\Minicart;
 
class Image
{
    public function aroundGetItemData($subject, $proceed, $item)
    {
        $result = $proceed($item);
        $result['product_image']['src'] = 'http://127.0.0.1/magento10/pub/media/catalog/product/cache/e4dee46576774a10ade3ee573d5868f9/m/b/mb02-gray-0.jpg';
        return $result;
    }
}
