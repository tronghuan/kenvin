<?php
class SM_ProductLabel_Model_Observer extends Varien_Event_Observer 
{
	public function addProductLabelAttributeToSelect(Varien_Event_Observer $observer)
	{
		$collection = $observer->getCollection();
		$collection->addAttributeToSelect('product_label');
	}

	public function addProductLabelsDataToProductCollection(Varien_Event_Observer $observer)
	{
		$collection = $observer->getCollection();
		foreach ($collection as $item) {
			$labels = explode(',', $item->getProductLabel());
			$_collection = Mage::getResourceModel('sm_productlabel/label_collection')
				->addFieldToFilter('label_id', array('in' => $labels));
			$_collection->getSelect()->group('positional');

			$item->setProductLabelsData($_collection);
		}
	}	

	public function addProductLabelsDataToProduct(Varien_Event_Observer $observer)
	{
		$model = $observer->getObject();
		if (!isset($model)) {
			return;
		}
		if ($model instanceof Mage_Catalog_Model_Product) {
			$labels = explode(',', $model->getProductLabel());
			$_collection = Mage::getResourceModel('sm_productlabel/label_collection')
				->addFieldToFilter('label_id', array('in' => $labels));
			$_collection->getSelect()->group('positional');

			$model->setProductLabelsData($_collection);
		}
	}
	
}
