<?php 
/**
* 
*/
class SM_Bestseller_Model_Source_Slide
{
	const TYPE_SIMPLE = 'simple';
	const TYPE_3D = '3d';
	protected $_options;
	public function toOptionArray()
	{
		if (!$this->_options) {
			$this->_options = array(
				array('value' => self::TYPE_SIMPLE, 
					'label' => Mage::helper('sm_bestseller')->__('Simple'),
				),
				array('value' => self::TYPE_3D, 
					'label' => Mage::helper('sm_bestseller')->__('3D Mode')),
				);
		}
		return $this->_options;
	}
}
 ?>