<?php 
$installer = Mage::getResourceModel('catalog/setup', 'catalog_setup');
$installer->startSetup();

$newAttribute = 'product_label';

$entity_type = Mage::getSingleton('eav/entity_type')->loadByCode('catalog_product');
$entity_type_id = $entity_type->getId();
$collection = Mage::getModel('eav/entity_attribute')
				->getCollection()
				->addFieldToFilter('entity_type_id', $entity_type_id)
				->addFieldToFilter('attribute_code', $newAttribute);

if (count($collection)) {
	$installer->removeAttribute($entity_type_id, $newAttribute);
}
$installer->addAttribute('catalog_product', 'product_label',array(
			'group'	       => 'Product Label',
			'label'        => 'Product Label',
			'type'         => 'varchar',
			'input'        => 'multiselect',
			'source'       => 'sm_productlabel/attribute_source_productlabel',
			'backend'      => 'eav/entity_attribute_backend_array',
			'global'       => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
			'visible'      => true,
			'required'     => false,
			'user_defined' => true,
			'searchable'   => false,
			'filterable'   => false,
			'comparable'   => false,
			'unique'       => false
));
$installer->run("
DROP TABLE IF EXISTS {$this->getTable('sm_productlabel')};
CREATE TABLE {$this->getTable('sm_productlabel')} (
  `label_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `imagename` text NOT NULL default '',
  `positional` int(6) unsigned NOT NULL,
  PRIMARY KEY (`label_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup(); 