<?php 
/**
* 
*/
class SM_Filter_Model_Observer 
	extends Varien_Event_Observer
{
	public function addNavigationDisplayTypeColumn(Varien_Event_Observer $observer)	
	{
		$form = $observer->getForm();
		/* @var Varien_Data_Form_Element_Fieldset */
		$fieldset = $form->getElement('front_fieldset');
		$fieldset->addField('navigation_display', 'select', array(
		    'name'      => 'navigation_display',
		    'label'     => Mage::helper('catalog')->__('Navigation type display'),
		    'title'     => Mage::helper('catalog')->__('Navigation type display'),
		    'note'      => Mage::helper('catalog')->__(''),
		    'values'    => SM_Filter_Model_Source_Navigation::toOptionArray(),
		), 'is_filterable');
	}
}