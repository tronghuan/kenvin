<?php 	
$install = $this;
$install->startSetup();

$newAttribute = 'is_featured';

$entity_type = Mage::getSingleton('eav/entity_type')->loadByCode('catalog_product');
$entity_type_id = $entity_type->getId();
$collection = Mage::getModel('eav/entity_attribute')
				->getCollection()
				->addFieldToFilter('entity_type_id', $entity_type_id)
				->addFieldToFilter('attribute_code', $newAttribute);

if (count($collection)) {
	$install->removeAttribute($entity_type_id, $newAttribute);
}
$install->addAttribute(Mage_Catalog_Model_Product::ENTITY, $newAttribute,
	array(
		'group' => 'General',
		'sort_order' => 0,
		'type' => 'int',
		'label' => 'Is featured',
		'input' => 'boolean',
		'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
		'visible' => true,
		'required' => false,
		'default' => 0,
		'visible_on_front' => false,
		));

$install->endSetup();

?>