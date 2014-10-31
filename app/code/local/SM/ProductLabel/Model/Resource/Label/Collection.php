<?php
class SM_ProductLabel_Model_Resource_Label_Collection 
	extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	function _construct()
	{
		$this->_init('sm_productlabel/label');
	}
}
?>