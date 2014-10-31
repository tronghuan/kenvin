<?php
/**
*
*/
class SM_Filter_Helper_Data
    extends Mage_Core_Helper_Abstract
{
	public function isAjaxEnable()
	{
        return Mage::getStoreConfigFlag('sm_filter/general/ajax_enable');
	}

	public function isPriceSliderEnabled()
	{
	    return Mage::getStoreConfigFlag('sm_filter/general/price_slider');
	}

	public function getPriceSliderDelay()
	{
	    return Mage::getStoreConfig('sm_filter/general/price_slider_delay');
	}

	public function getPriceSliderSubmitType()
	{
	    return (int) Mage::getStoreConfig('sm_filter/general/price_slider_submit_type');
	}
}

 ?>
