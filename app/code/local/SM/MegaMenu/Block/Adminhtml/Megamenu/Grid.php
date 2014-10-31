<?php

class SM_MegaMenu_Block_Adminhtml_Megamenu_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('megamenu_grid');
        $this->setDefaultSort('sm_megamenu_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(false);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sm_megamenu/megamenu')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('sm_megamenu_id', array(
            'header'    => Mage::helper('sm_megamenu')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'sm_megamenu_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('sm_megamenu')->__('Name'),
            'align'     =>'left',
            'index'     => 'name',
        ));
        $this->addColumn('type', array(
            'header'    => Mage::helper('sm_megamenu')->__('Type'),
            'align'     =>'left',
            'index'     => 'type',
            'type'  => 'options',
            'options' => array(
                SM_MegaMenu_Model_Megamenu::TYPE_CATEGORY => 'Category',
                SM_MegaMenu_Model_Megamenu::TYPE_STATIC_BLOCK => 'Static block',
                ),
        ));
        $this->addColumn('type_value', array(
            'header'    => Mage::helper('sm_megamenu')->__('Value'),
            'align'     =>'left',
            'index'     => 'type_value',
            'renderer' => 'SM_MegaMenu_Block_Adminhtml_Renderer_Typevalue'
        ));

        $this->addColumn('is_active', array(
            'header'    => Mage::helper('sm_megamenu')->__('Active'),
            'align'     =>'left',
            'index'     => 'is_active',
            'type' => 'options',
            'options' => array(
                0 => 'Inactive',
                1 => 'Active'
                ),
        ));

        // $this->addColumn('delete', array());

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
