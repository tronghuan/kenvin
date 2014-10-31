<?php
/**
*
*/
class SM_Slider_Block_Adminhtml_Slider_Edit
	extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_blockGroup = 'sm_slider';
		$this->_controller = 'adminhtml_slider';
	}

	public function getHeaderText()
	{
		if (Mage::registry('slider_data') && Mage::registry('slider_data')->getId()) {
			return Mage::helper('sm_slider')
				->__('Edit Slider "%s"', $this->htmlEscape(Mage::registry('slider_data')->getTitle()));
		} else {
			return Mage::helper('sm_slider')
				->__('New Slider');
		}

	}
}
 ?>
