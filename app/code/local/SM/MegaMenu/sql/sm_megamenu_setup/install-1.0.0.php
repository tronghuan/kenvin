<?php
$install = $this;

$install->getConnection()
	->dropTable($install->getTable('sm_megamenu/sm_megamenu'));

$table = $install->getConnection()
	->newTable($install->getTable('sm_megamenu/sm_megamenu'))
	->addColumn(
		$install->getTable('sm_megamenu/sm_megamenu').'_id',
		Varien_Db_Ddl_Table::TYPE_INTEGER,
		null,
		array(
			'unsigned' => true,
			'nullable' => false,
			'primary' => true,
			'identity' => true
			),
		'ID')
	->addColumn(
		'name',
		Varien_Db_Ddl_Table::TYPE_VARCHAR,
		512,
		array('nullable' => false),
		'Name')
	->addColumn(
		'is_active',
		Varien_Db_Ddl_Table::TYPE_BOOLEAN,
		null,
		array('nullable' => false),
		'Is active')
	->addColumn(
		'sort_order',
		Varien_Db_Ddl_Table::TYPE_INTEGER,
		null,
		array('nullable' => false),
		'Sort order')
	->addColumn(
		'type',
		Varien_Db_Ddl_Table::TYPE_VARCHAR,
		32,
		array('nullable' => false),
		'Menu Type')
	->addColumn(
		'type_value',
		Varien_Db_Ddl_Table::TYPE_INTEGER,
		null,
		array('nullable' => false),
		'Value id');
$install->getConnection()->createTable($table);
 ?>
