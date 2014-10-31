<?php 

class SM_ProductLabel_Helper_Data 
	extends Mage_Core_Helper_Abstract
{
	public function isProductLabelEnable()
	{
		return Mage::getStoreConfigFlag('sm_productlabel/general/enable');
	}

	public function getProductLabels($labelString)
	{
		$labels = explode(',', $labelString);
		$collection = Mage::getResourceModel('sm_productlabel/label_collection');

		$collection->getSelect()->group('positional');
		return $collection;
	}

	public function getStylePosition($i)
	{
		switch ($i) {
			case 1:
				$result = 'top-left';
				break;
			case 2:
				$result = 'top-right';
				break;
			case 3:
				$result = 'bottom-left';
				break;
			case 4:
				$result = 'bottom-right';
				break;
			default:
				$result = 'bottom-right';
				break;
		}
		return $result;
	}
}
