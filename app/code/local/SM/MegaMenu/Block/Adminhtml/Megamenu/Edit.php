<?php 
/**
* 
*/
class SM_MegaMenu_Block_Adminhtml_Megamenu_Edit 
	extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()	
	{
		parent::__construct();
		$this->_blockGroup = 'sm_megamenu';
		$this->_controller = 'adminhtml_megamenu';
	}

	public function getHeaderText()
	{
		if (Mage::registry('megamenu_data') && Mage::registry('megamenu_data')->getId()) {
			return Mage::helper('sm_megamenu')
				->__("Edit Mega Menu: %s", $this->htmlEscape(Mage::registry('megamenu_data')->getName()));
		} else {
			return Mage::helper('sm_megamenu')
				->__('New Mega Menu');
		}
		
	}
}
 ?>