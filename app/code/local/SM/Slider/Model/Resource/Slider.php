<?php 
/**
* 
*/
class SM_Slider_Model_Resource_Slider
	 extends Mage_Core_Model_Resource_Db_Abstract
{
	
	protected function _construct()
	{
		$this->_init('sm_slider/sm_slider', 'entity_id');
	}
}
 ?>