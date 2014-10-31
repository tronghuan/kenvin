<?php
	/**
	* 
	*/
	class SM_ProductLabel_Block_Adminhtml_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
	{
		
		public function render(Varien_Object $row)
		{
			$value = $row->getData($this->getColumn()->getIndex());
			return '<img width="150px" height="80px" src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'SM/ProductLabel/images/'.$value.'" />';
		}
	}
?>