<?php
/**
*
*/
class SM_Slider_Block_Adminhtml_Image_Edit
	extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_blockGroup = 'sm_slider';
		$this->_controller = 'adminhtml_image';
	}

	public function getHeaderText()
	{
		if (Mage::registry('image_data') && Mage::registry('image_data')->getId()) {
			return Mage::helper('sm_slider')
				->__("Edit Slider Image: %s", $this->htmlEscape(Mage::registry('image_data')->getName()));
		} else {
			return Mage::helper('sm_slider')
				->__('New Slider Image');
		}

	}
}
 ?>
