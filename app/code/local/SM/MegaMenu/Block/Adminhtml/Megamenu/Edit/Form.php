<?php 
/**
* 
*/
class SM_MegaMenu_Block_Adminhtml_Megamenu_Edit_Form
	extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		if (Mage::registry('megemenu_data')) {
			$data = Mage::registry('megemenu_data');
		// } elseif (is_array(Mage::getSingleton('adminhtml/session'))->getFormData()) {
		// 	$data = Mage::getSingleton('adminhtml/session')->getFormData();
		} else {
			$data = array();
		}
		$form = new Varien_Data_Form(array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
			'method' => 'POST',
			));

		$form->setUseContainer(true);
		$this->setForm($form);
			
		$form->setValues($data);
		return parent::_prepareForm();
	}
	
}
 ?>