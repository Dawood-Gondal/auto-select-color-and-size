<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_AutoSelectColorAndSize
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\AutoSelectColorAndSize\Block;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Product Category Details
 */
class ProductDetails extends Template
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @param Registry $registry
     * @param CollectionFactory $productCollectionFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Registry $registry,
        CollectionFactory $productCollectionFactory,
        Context $context,
        array $data = []
    ){
        $this->registry = $registry;
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return bool
     */
    public function getAutoColorSelectionStatusProductPage()
    {
        $status = false;
        $productAttrAutoColor = $this->getProductAttrAutoColorValue();
        if (isset($productAttrAutoColor)) {
            if ($productAttrAutoColor == true) {
                $status = true;
            }
        }
        return $status;
    }

    /**
     * @return bool|mixed
     */
    public function getProductAttrAutoColorValue()
    {
        $product = $this->getProduct();
        $productDetails = $product->getData();
        if (array_key_exists('auto_color', $productDetails)) {
            $productAttrAutoColor = $productDetails['auto_color'];
            return $productAttrAutoColor;
        } else {
            $productAttrAutoColor = false;
            return $productAttrAutoColor;
        }
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        $product = $this->registry->registry('current_product');
        return $product;
    }

    /**
     * @return bool
     */
    public function getAutoSizeSelectionStatusProductPage()
    {
        $status = false;
        $productAttrAutoSize = $this->getProductAttrAutoSizeValue();
        if (isset($productAttrAutoSize)) {
            if ($productAttrAutoSize == true) {
                $status = true;
            }
        }
        return $status;
    }

    /**
     * @return bool|mixed
     */
    public function getProductAttrAutoSizeValue()
    {
        $product = $this->getProduct();
        $productDetails = $product->getData();
        if (array_key_exists('auto_size', $productDetails)) {
            $productAttrAutoSize = $productDetails['auto_size'];
            return $productAttrAutoSize;
        } else {
            $productAttrAutoSize = false;
            return $productAttrAutoSize;
        }
    }
}
