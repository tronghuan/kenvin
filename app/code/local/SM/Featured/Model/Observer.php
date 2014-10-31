<?php 
/**
* 
*/
class SM_Featured_Model_Observer 
	extends Varien_Event_Observer
{
	public function addFeatured(Varien_Event_Observer $observer)	
	{
		$block = $observer->getBlock();
		if (!isset($block)) {
			return;
		}
		if ($block->getType() == 'adminhtml/catalog_product_grid') {
			$block->addColumnAfter('is_featured',
			    array(
			        'header'=> Mage::helper('sm_featured')->__('Is featured'),
			        'width' => '70px',
			        'index' => 'is_featured',
			        'type'  => 'options',
			        'options' => array(
			        	0 => 'Disable',
			        	1 => 'Enable'
			        	),
			), 'type');
		}
	}

	public function addMassaction(Varien_Event_Observer $observer)
	{
		$block = $observer->getBlock();
		if (!isset($block)) {
			return;
		}
		$block->getMassactionBlock()->addItem('set_fetured', array(
			'label' => Mage::helper('sm_featured')->__('Set featured'),
			'url' => Mage::app()->getStore()->getUrl('*/*/massFeatured', array('_current'=>true)),
			'additional' => array(
				'visibility' => array(
					'name' => 'status',
					'type' => 'select',
					'class' => 'required-entry',
					'label' => Mage::helper('sm_featured')->__('Status'),
					'values' => array(
						0 => 'Disable',
						1 => 'Enable',
						),
					),
				),
			));
	}

	public function addFeaturedAttributeToSelect(Varien_Event_Observer $observer)
	{
		$collection = $observer->getCollection();
		if (!isset($collection)) {
			return;
		}
		if ($collection instanceof Mage_Catalog_Model_Resource_Product_Collection) {
			$collection->addAttributeToSelect('is_featured');
		}
	}
}
 ?>