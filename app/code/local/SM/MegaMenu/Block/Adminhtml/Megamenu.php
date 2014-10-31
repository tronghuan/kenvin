<?php

class SM_MegaMenu_Block_Adminhtml_Megamenu
	extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'sm_megamenu';
        $this->_controller = 'adminhtml_megamenu';
        $this->_headerText = Mage::helper('sm_megamenu')->__('Mega Menu');
        parent::__construct();
    }
}