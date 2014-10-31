<?php
class SM_Featured_Block_Product extends Mage_Catalog_Block_Product_Abstract
{
    const DEFAULT_PRODUCTS_COUNT = 15;

    public function _construct()
    {
        parent::_construct();
        if ($numberProduct = Mage::getStoreConfig('sm_featured/general/number_product')) 
        {
            $this->setProductsCount($numberProduct);
        }
    }

    protected function _getProductCollection()
    {
        /** @var $collection Mage_Catalog_Model_Resource_Product_Collection */
        $collection = Mage::getResourceModel('catalog/product_collection');
        if ($this->inCategory()) {
            $category = Mage::registry('current_category');
            $collection
                ->joinField('category_id',
                            'catalog/category_product',
                            'category_id',
                            'product_id=entity_id',
                            null,
                            'left')
                ->addAttributeToFilter('category_id', array('in', $category->getAllChildren(true)));
        }
        $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());

        $collection = $this->_addProductAttributesAndPrices($collection);


            $collection->addStoreFilter()
            ->addAttributeToFilter('is_featured', 1)
            ->setPageSize($this->getProductsCount())
            ->setCurPage(1);

        return $collection;
    }
    public function isShowLabel()
    {
        if (Mage::getStoreConfigFlag('sm_featured/general/show_label') 
            && Mage::getStoreConfigFlag('sm_productlabel/general/enable')) {
            return true;
        }
        return false;
    }

    /**
     * Prepare collection with new products
     *
     * @return Mage_Core_Block_Abstract
     */
    protected function _beforeToHtml()
    {
        $this->setProductCollection($this->_getProductCollection());
        return parent::_beforeToHtml();
    }

    public function _getSlidePerView()
    {
        return Mage::getStoreConfig('sm_featured/general/slide_per_view');
    }

    public function _getAutoplay()
    {
        return Mage::getStoreConfig('sm_featured/general/autoplay');
    }
    public function _getSpeed()
    {
        return Mage::getStoreConfig('sm_featured/general/speed');
    }

    public function setInCategory($value)
    {
        $this->_is_category = $value;
        return $this;
    }

    public function inCategory()
    {
        if (null === $this->_is_category) {
            return false;
        }
        return true;
    }

    /**
     * Set how much product should be displayed at once.
     *
     * @param $count
     * @return Mage_Catalog_Block_Product_New
     */
    public function setProductsCount($count)
    {
        $this->_productsCount = $count;
        return $this;
    }

    /**
     * Get how much products should be displayed at once.
     *
     * @return int
     */
    public function getProductsCount()
    {
        if (null === $this->_productsCount) {
            $this->_productsCount = self::DEFAULT_PRODUCTS_COUNT;
        }
        return $this->_productsCount;
    }

    public function _getSwipperScript()
    {
        $script = "<script>
            \$j(function() {
                var featuredSwiper = \$j('.swiper-featured-container').swiper({
                    slidesPerView:".$this->_getSlidePerView().",";

            if (Mage::getStoreConfig('sm_featured/general/type') == '3d') {
                $script .= "
                    centeredSlides: true,
                    initialSlide: 7,
                    tdFlow: {
                        rotate : 30,
                        stretch :10,
                        depth: 150
                    },
                    ";
            }
                $script .= "
                    offsetPxBefore:10,
                    offsetPxAfter:10,
                    calculateHeight: true,
                    autoplay: ".$this->_getAutoplay().",
                    speed: ".$this->_getSpeed().",
                ";
            
        $script .= '});
                $j(".swiper-featured-container .arrow-left").on("click", function(e){
                    e.preventDefault()
                    featuredSwiper.swipePrev()
                  });
                  $j(".swiper-featured-container .arrow-right").on("click", function(e){
                    e.preventDefault()
                    featuredSwiper.swipeNext()
                  });
            })</script>';
        return $script;
    }
}