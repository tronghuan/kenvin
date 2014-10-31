<?php
class SM_ProductLabel_Model_Resource_Label 
	extends Mage_Core_Model_Resource_Db_Abstract
{
	function _construct()
	{
		$this->_init('sm_productlabel/sm_productlabel','label_id');
	}
}
?>