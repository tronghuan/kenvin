<?php

$installer = $this;
$installer->startSetup();
$installer->getConnection()
    ->dropTable($installer->getTable('sm_slider/sm_slider'));

$installer->getConnection()
    ->dropTable($installer->getTable('sm_slider/sm_slider_image'));

$table = $installer->getConnection()
    ->newTable($installer->getTable('sm_slider/sm_slider'))
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'identity' => true,
            ),
        'ID')
    ->addColumn(
        'name',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        512,
        array('nullable' => false),
        'Slider name');

$installer->getConnection()->createTable($table);



$tableImage = $installer->getConnection()
    ->newTable($installer->getTable('sm_slider/sm_slider_image'))
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'identity' => true,
            ),
        'ID')
    ->addColumn(
        'name',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        512,
        array('nullable' => false),
        'Iamge name')
    ->addColumn(
        'text',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        array('nullable' => true),
        'Text in image')
    ->addColumn(
        'is_active',
        Varien_Db_Ddl_Table::TYPE_BOOLEAN,
        null,
        array('nullable' => false),
        'Is Active')
    ->addColumn(
        'sort_order',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array('nullable' => false),
        'Sort order')
    ->addColumn(
        'path',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        512,
        array('nullable' => false),
        'Image path')
    ->addColumn(
        'slider_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array('unsigned' => true, 'nullable' => true),
        'Slider id');

$installer->getConnection()->createTable($tableImage);


$installer->endSetup();