<?php 	
// die(get_class($this));
/* @var Mage_Core_Model_Resource_Setup */
$install = $this;
$install->startSetup();

$table = $install->getTable('catalog/eav_attribute');

$this->getConnection()
	->addColumn($table,
		'navigation_display',
		array(
			'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
			'nullable' => true,
			'default' => null,
			'comment' => 'Navigation display type'
			)
		);

$install->endSetup();

?>