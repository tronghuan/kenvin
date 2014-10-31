<?php

class SM_Slider_Block_Adminhtml_Image_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('megamenu_grid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(false);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sm_slider/image')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('sm_slider')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'entity_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('sm_slider')->__('Name'),
            'align'     =>'left',
            'index'     => 'name',
        ));

        $this->addColumn('image_view', array(
            'header'    => Mage::helper('sm_slider')->__('Image show'),
            'align'     =>'center',
            'index'     => 'path',
            'renderer' => 'SM_Slider_Block_Adminhtml_Renderer_Imageshow'
            ));

        $this->addColumn('text', array(
            'header'    => Mage::helper('sm_slider')->__('Text'),
            'align'     =>'left',
            'index'     => 'text',
        ));
        $this->addColumn('slider', array(
            'header'    => Mage::helper('sm_slider')->__('Slider Name'),
            'align'     =>'left',
            'index'     => 'slider_id',
            'renderer' => 'SM_Slider_Block_Adminhtml_Renderer_Slider'
        ));

        $this->addColumn('sort_order', array(
            'header'    => Mage::helper('sm_slider')->__('Sort order'),
            'align'     =>'left',
            'index'     => 'sort_order',
        ));

        $this->addColumn('is_active', array(
            'header'    => Mage::helper('sm_slider')->__('Active'),
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
