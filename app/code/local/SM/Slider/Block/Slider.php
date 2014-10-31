<?php 
/**
* 
*/
class SM_Slider_Block_Slider 
	extends Mage_Core_Block_Template
{
	protected function _getSliderId()
	{
		if ($this->getSliderId()) {
			return $this->getSliderId();
		}
		elseif (Mage::getStoreConfig('sm_slider/general/homeslide')) {
			return Mage::getStoreConfig('sm_slider/general/homeslide');
		}
		else {
			return Mage::getResourceModel('sm_slider/image_collection')
				->getFirstItem()->getId();
		}
	}
	public function getImages()
	{
		if ($this->_getSliderId()) {
			
			$collection = Mage::getResourceModel('sm_slider/image_collection')
				->addFieldToFilter('is_active', 1)
				->setOrder('sort_order', 'ASC')
				->addFieldToFilter('slider_id', $this->_getSliderId());
			if ($collection->count() == 0) {
				return false;
			}
			return $collection;
		}
		return false;
	}

	public function getSliderConfig($value)
	{
		if (Mage::getStoreConfig('sm_slider/general/'.$value)) {
			return Mage::getStoreConfig('sm_slider/general/'.$value);
		}
	}
}
 ?>