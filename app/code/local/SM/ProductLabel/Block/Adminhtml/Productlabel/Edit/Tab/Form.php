<?php

class SM_ProductLabel_Block_Adminhtml_ProductLabel_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('productlabel_form', array('legend'=>Mage::helper('sm_productlabel')->__('Product Label Information')));
     
      $fieldset->addField('name', 'text', array(
          'label'     => Mage::helper('sm_productlabel')->__('Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'name',
      ));
      
      $fieldset->addField('imagename','file', array(
          'label'    =>Mage::helper('sm_productlabel')->__('Image'),
          // 'class'    => 'required-entry',
          // 'required' =>true,
          'name'     => 'imagename',
      )); 
      $fieldset->addField('positional','select',array(
          'label'    => Mage::helper('sm_productlabel')->__('Positional'),
          'name'     => 'positional',
          'type'   => 'options',
          'options'  => Mage::getSingleton('sm_productlabel/system_config_source_positional')->getOptionArray()
      ));
      if ( Mage::getSingleton('adminhtml/session')->getMegamenuData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSliderData());
          Mage::getSingleton('adminhtml/session')->setSliderData(null);
      } elseif ( Mage::registry('productlabel_data') ) {
          $form->setValues(Mage::registry('productlabel_data')->getData());
      }
      return parent::_prepareForm();
  }
}