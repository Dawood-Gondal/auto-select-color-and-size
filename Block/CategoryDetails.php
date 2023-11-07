<?php
/**
 * @category    M2Commerce Enterprise
 * @package     M2Commerce_AutoSelectColorAndSize
 * @copyright   Copyright (c) 2023 M2Commerce Enterprise
 * @author      dawoodgondaldev@gmail.com
 */

namespace M2Commerce\AutoSelectColorAndSize\Block;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\Layer;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class CategoryDetails
 */
class CategoryDetails extends Template
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Layer
     */
    protected $catalogLayer;

    /**
     * @var CategoryFactory
     */
    protected $categoryFactory;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @param Registry $registry
     * @param CategoryFactory $categoryFactory
     * @param Product $product
     * @param Resolver $layerResolver
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Registry $registry,
        CategoryFactory $categoryFactory,
        Product $product,
        Resolver $layerResolver,
        Context $context,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->categoryFactory = $categoryFactory;
        $this->product = $product;
        $this->catalogLayer = $layerResolver->get();
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getAutoColorSelectionStatusCategoryPage()
    {
        $autoColorProductId = [];
        $currentCategory = $this->getCurrentCategory();
        $categoryId = $currentCategory->getId();
        $category = $this->categoryFactory->create()->load($categoryId);
        $categoryProducts = $category->getProductCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('auto_color', 1)
            ->load();
        foreach ($categoryProducts as $categoryProduct) {
            $autoColorProductId[] = $categoryProduct->getId();
        }
        return $autoColorProductId;
    }

    /**
     * @return Category|mixed|Category
     */
    public function getCurrentCategory()
    {
        $category = null;
        if ($this->catalogLayer) {
            $category = $this->catalogLayer->getCurrentCategory();
        } elseif ($this->registry->registry('current_category')) {
            $category = $this->registry->registry('current_category');
        }
        return $category;
    }

    /**
     * @return array
     */
    public function getAutoSizeSelectionStatusCategoryPage()
    {
        $autoSizeProductId = [];
        $currentCategory = $this->getCurrentCategory();
        $categoryId = $currentCategory->getId();
        $category = $this->categoryFactory->create()->load($categoryId);
        $categoryProducts = $category->getProductCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('auto_size', 1)
            ->load();
        foreach ($categoryProducts as $categoryProduct) {
            $autoSizeProductId[] = $categoryProduct->getId();
        }
        return $autoSizeProductId;
    }
}
