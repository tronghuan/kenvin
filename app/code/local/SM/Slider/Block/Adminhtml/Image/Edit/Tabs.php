<?php
/**
*
*/
class SM_Slider_Block_Adminhtml_Image_Edit_Tabs
	 extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('slider_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('sm_slider')->__('Form Tabs'));
	}

	protected function _beforeToHtml()
	{
		$this->addTab('general', array(
			'label' => Mage::helper('sm_slider')->__('General'),
			'title' => Mage::helper('sm_slider')->__('General'),
			'content' =>
				$this->getLayout()
					->createBlock('sm_slider/adminhtml_image_edit_tabs_form')
					->toHtml()
			));
		return parent::_beforeToHtml();
	}
}
 ?>
