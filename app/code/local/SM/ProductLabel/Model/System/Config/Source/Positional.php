<?php


	class SM_ProductLabel_Model_System_Config_Source_Positional
	{
	    public function toOptionArray()
	    {
	        return array(
	        	array('value'=>'1', 'label'=>Mage::helper('sm_productlabel')->__('Top-Left')),
				array('value'=>'2', 'label'=>Mage::helper('sm_productlabel')->__('Top-Right')),
				array('value'=>'3', 'label'=>Mage::helper('sm_productlabel')->__('Bot-Left')),
				array('value'=>'4', 'label'=>Mage::helper('sm_productlabel')->__('Bot_Right'))
	        );
	    }    
	    static public function getOptionArray()
	    {
	        return array(
	            '1'    => Mage::helper('sm_productlabel')->__('Top-Left'),
	            '2'   => Mage::helper('sm_productlabel')->__('Top-Right'),
	            '3'    => Mage::helper('sm_productlabel')->__('Bot-Left'),
	            '4'   => Mage::helper('sm_productlabel')->__('Bot_Right'),
	        );
	    }	
	}
?>