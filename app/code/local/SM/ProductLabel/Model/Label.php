<?php
class SM_ProductLabel_Model_Label extends Mage_Core_Model_Abstract
{
	function _construct()
	{
		parent::_construct();
		$this->_init('sm_productlabel/label');
	}
}
?>