<?php
class SM_ProductLabel_Block_Adminhtml_ProductLabel extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_controller = 'adminhtml_productlabel';
		$this->_blockGroup = 'sm_productlabel';
		$this->_headerText = Mage::helper('sm_productlabel')->__('Label Manager');
		$this->_addButtonLabel = Mage::helper('sm_productlabel')->__('Add Label');
		parent::__construct();
	}
}