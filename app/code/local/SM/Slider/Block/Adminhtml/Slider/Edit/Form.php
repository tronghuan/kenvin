<?php 
/**
* 
*/
class SM_Slider_Block_Adminhtml_Slider_Edit_Form
	extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		if (Mage::registry('slider_data')) {
			$data = Mage::registry('slider_data');
		} elseif (is_array(Mage::getSingleton('adminhtml/session'))->getFormData()) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData();
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
		$fieldset = $form->addFieldset('slider_form', array(
			'legend' => Mage::helper('sm_slider')->__('Slider Infomation')
			));
		$fieldset->addField('name', 'text', array(
			'label' => Mage::helper('sm_slider')->__('Slider Name'),
			'class' => 'required-entity',
			'required' => true,
			'name' => 'name'
			));
		$form->setValues($data);
		return parent::_prepareForm();
	}
	
}
 ?>