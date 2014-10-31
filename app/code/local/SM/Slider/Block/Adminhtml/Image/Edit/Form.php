<?php
/**
*
*/
class SM_Slider_Block_Adminhtml_Image_Edit_Form
	extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		if (Mage::registry('image_data')) {
			$data = Mage::registry('image_data');
		} else {
			$data = array();
		}
		$form = new Varien_Data_Form(array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
			'method' => 'POST',
			'enctype' => 'multipart/form-data',
			));

		$form->setUseContainer(true);
		$this->setForm($form);

		$form->setValues($data);
		return parent::_prepareForm();
	}

}
 ?>
