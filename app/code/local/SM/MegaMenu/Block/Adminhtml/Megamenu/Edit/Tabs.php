<?php 
/**
* 
*/
class SM_MegaMenu_Block_Adminhtml_Megamenu_Edit_Tabs
	 extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()	
	{
		parent::__construct();
		$this->setId('meagemenu_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('sm_megamenu')->__('Form Tabs'));
	}

	protected function _beforeToHtml()
	{
		$this->addTab('general', array(
			'label' => Mage::helper('sm_megamenu')->__('General'),
			'title' => Mage::helper('sm_megamenu')->__('General'),
			'content' => 
				$this->getLayout()
					->createBlock('sm_megamenu/adminhtml_megamenu_edit_tabs_form')
					->toHtml()
			));
		return parent::_beforeToHtml();
	}
}
 ?>