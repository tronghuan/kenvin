<?php 
/**
* 
*/
class SM_Bestseller_Block_Bestseller_Home 
	extends Mage_Catalog_Block_Product_Abstract
    implements Mage_Widget_Block_Interface
{
    protected $_serializer = null;

    /**
     * Initialization
     */
    protected function _construct()
    {
        $this->_serializer = new Varien_Object();
        parent::_construct();
    }

    protected function _toHtml(){
        $list = $this->getBestsellerProducts();
        $this->assign('list', $list);
        return parent::_toHtml();
    }

	public function getBestsellerProducts()	
	{
        $configPath = $this->configPath();
		$store_id = (int) Mage::app()->getStore()->getId();
		$collection = Mage::getResourceModel('catalog/product_collection')
			->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
			->addStoreFilter()
			->addPriceData()
			->addTaxPercents()
			->addUrlRewrite()
			->setPageSize(Mage::getStoreConfig($configPath.'number_product'));

        $category = Mage::registry('current_category');

        if(is_object($category)){
            $collection
                ->joinField('category_id',
                    'catalog/category_product',
                    'category_id',
                    'product_id=entity_id',
                    null,
                    'left')
                ->addAttributeToFilter('category_id', array('in', $category->getAllChildren(true)));
        }
		// join with bestseller table
		$collection->getSelect()
			->joinLeft(
				array('aggregation' => $collection->getResource()->getTable('sales/bestsellers_aggregated_monthly')),
					"e.entity_id = aggregation.product_id AND aggregation.store_id={$store_id}",
					array('SUM(aggregation.qty_ordered) AS sold_quantity')
				)
			->group('e.entity_id')
			->order(array('sold_quantity DESC', 'e.created_at'));

		Mage::getSingleton('catalog/product_status')
			->addVisibleFilterToCollection($collection);
		Mage::getSingleton('catalog/product_visibility')
			->addVisibleInCatalogFilterToCollection($collection);

		return $collection;
	}

    public function configPath(){
        if(Mage::registry('current_category') !== null){
            return $configPath = 'sm_bestseller/category_slider/';
        }else {
            return $configPath = 'sm_bestseller/home_slider/';
        }
    }

    public function getSwipperScript()
    {
        $configPath = $this->configPath();
        $script = "<script>
		    \$j(function() {
		        var bestSellerSwiper = \$j('.swiper-bestseller-container').swiper({
		            slidesPerView:".Mage::getStoreConfig($configPath.'slide_per_view').",
		            loop: ". Mage::getStoreConfig($configPath.'loop') .",";

        if (Mage::getStoreConfig($configPath.'effect') == '3d') {
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
		            autoplay: ".Mage::getStoreConfig($configPath.'autoplay').",
		            speed: ".Mage::getStoreConfig($configPath.'speed').",
		        ";

        $script .= '});
				$j(".swiper-bestseller-container .arrow-left").on("click", function(e){
				    e.preventDefault()
				    bestSellerSwiper.swipePrev()
				  });
				  $j(".swiper-bestseller-container .arrow-right").on("click", function(e){
				    e.preventDefault()
				    bestSellerSwiper.swipeNext()
				  });
			})</script>';
        return $script;
    }

    public function isShowLabel()
    {
        if (Mage::getStoreConfigFlag('sm_bestseller/general/show_label')
            && Mage::getStoreConfigFlag('sm_productlabel/general/enable')) {
            return true;
        }
        return false;
    }
}
