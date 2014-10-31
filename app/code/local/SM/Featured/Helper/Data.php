<?php 
/**
* 
*/
class SM_Featured_Helper_Data 
	extends Mage_Core_Helper_Abstract
{
	const TEMPLATE_FILE = 'sm/featured/product.phtml';
	
	public function getTemplateForHomePage()	
	{
		if (Mage::getStoreConfig('sm_featured/general/enable') 
			&& Mage::getStoreConfig('sm_featured/general/show_in_home')) {
			return self::TEMPLATE_FILE;
		}
		return;
	}

	public function getTemplateForCategoryPage()	
	{
		if (Mage::getStoreConfig('sm_featured/general/enable') 
			&& Mage::getStoreConfig('sm_featured/general/show_in_category')) {
			return self::TEMPLATE_FILE;
		}
		return;
	}
}
 ?>