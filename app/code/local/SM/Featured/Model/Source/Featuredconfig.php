<?php 
/**
* 
*/
class SM_Featured_Model_Source_Featuredconfig
{
	const TYPE_SIMPLE = 'simple';
	const TYPE_3D = '3d';
	protected $_options;
	public function toOptionArray()
	{
		if (!$this->_options) {
			$this->_options = array(
				array('value' => self::TYPE_SIMPLE, 
					'label' => Mage::helper('sm_featured')->__('Simple'),
				),
				array('value' => self::TYPE_3D, 
					'label' => Mage::helper('sm_featured')->__('3D Mode')),
				);
		}
		return $this->_options;
	}
}
 ?>