<?php

class SM_ProductLabel_Block_Adminhtml_ProductLabel_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('productlabel_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('sm_productlabel')->__('Product Label Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('sm_productlabel')->__('Product Label Information'),
          'title'     => Mage::helper('sm_productlabel')->__('Product Label Information'),
          'content'   => $this->getLayout()->createBlock('sm_productlabel/adminhtml_productlabel_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}