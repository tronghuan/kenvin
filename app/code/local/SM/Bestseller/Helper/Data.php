<?php 
/**
* 
*/
class SM_Bestseller_Helper_Data 
	extends Mage_Core_Helper_Abstract
{
	const TEMPLATE_FILE = 'sm/bestseller/product.phtml';
	
	public function getTemplateForHomePage()	
	{
		if (Mage::getStoreConfig('sm_bestseller/general/enable') 
			&& Mage::getStoreConfig('sm_bestseller/general/show_in_home')) {
			return self::TEMPLATE_FILE;
		}
		return;
	}

	public function getTemplateForCategoryPage()	
	{
		if (Mage::getStoreConfig('sm_bestseller/general/enable') 
			&& Mage::getStoreConfig('sm_bestseller/general/show_in_category')) {
			return self::TEMPLATE_FILE;
		}
		return;
	}
}
