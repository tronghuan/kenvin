<?php 
/**
* 
*/
class SM_Slider_Model_Source_Sliderconfig
{
	const MODE_HORIZONTAL = 'horizontal';
	const MODE_VERTICAL = 'vertical';
	protected $_options;
	public function toOptionArray()
	{
		if (!$this->_options) {
			$this->_options = array(
				array('value' => self::MODE_HORIZONTAL, 
					'label' => Mage::helper('sm_slider')->__('Horizontal'),
				),
				array('value' => self::MODE_VERTICAL, 
					'label' => Mage::helper('sm_slider')->__('Vertical')),
				);
		}
		return $this->_options;
	}
}
 ?>