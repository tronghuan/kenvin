<?php

class SM_Slider_Block_Adminhtml_Slider 
	extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'sm_slider';
        $this->_controller = 'adminhtml_slider';
        $this->_headerText = Mage::helper('sm_slider')->__('Slider');
        parent::__construct();
    }
}