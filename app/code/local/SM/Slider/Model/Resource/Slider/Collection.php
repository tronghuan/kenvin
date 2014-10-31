<?php
/**
*
*/
class SM_Slider_Model_Resource_Slider_Collection
	extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	protected function _construct()
	{
		$this->_init('sm_slider/slider');
	}

    public function toOptionArray()
    {
        return $this->_toOptionArray('entity_id', 'name');
    }
}
 ?>
