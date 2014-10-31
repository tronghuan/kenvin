<?php

class SM_ProductLabel_Block_Adminhtml_ProductLabel_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_objectId = 'id';
        $this->_blockGroup = 'sm_productlabel';
        $this->_controller = 'adminhtml_productlabel';
        $this->_updateButton('save','label',Mage::helper('sm_productlabel')->__('Save Product Label'));
        $this->_updateButton('delete','label',Mage::helper('sm_productlabel')->__('Delete Product Label'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
        $this->_formScripts[] = "
        	function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            };
        ";
	}

	public function getHeaderText()
    {
        if( Mage::registry('productlabel_data') && Mage::registry('productlabel_data')->getId() ) {
            return Mage::helper('sm_productlabel')->__("Edit Product Label '%s'", $this->htmlEscape(Mage::registry('productlabel_data')->getTitle()));
        } else {
            return Mage::helper('sm_productlabel')->__('Add Product Label');
        }
    }
}