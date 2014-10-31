<?php

class SM_ProductLabel_Block_Adminhtml_ProductLabel_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('productlabelGrid');
        $this->setDefaultSort('label_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sm_productlabel/label')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('label_id', array(
            'header'    => Mage::helper('sm_productlabel')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'label_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('sm_productlabel')->__('Name'),
            'align'     =>'left',
            'index'     => 'name',
        ));
        $this->addColumn('Image' , array(
            'header'    => Mage::helper('sm_productlabel')->__('Image'),
            'width'     => '150px',
            'index' =>'imagename',
            'renderer' =>'SM_ProductLabel_Block_Adminhtml_Renderer_Image',
        ));

        $this->addColumn('Positional' , array(
            'header'    => Mage::helper('sm_productlabel')->__('Positional'),
            'width'     => '150px',
            'index'     => 'positional',
            'type' => 'options',  
            'options'   => Mage::getSingleton('sm_productlabel/system_config_source_positional')->getOptionArray(),
        ));
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('sm_productlabel')->__('Edit'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('sm_productlabel')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));


        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
    $this->setMassactionIdField('label_id');
    $this->getMassactionBlock()->setFormFieldName('productlabel');

    $this->getMassactionBlock()->addItem('delete', array(
    'label'    => Mage::helper('sm_productlabel')->__('Delete'),
    'url'      => $this->getUrl('*/*/massDelete'),
    'confirm'  => Mage::helper('sm_productlabel')->__('Are you sure?')
    ));
    return $this;
    }

    public function getRowUrl($row)
    {
    return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}