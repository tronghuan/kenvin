<?php
/**
*
*/
class SM_Slider_Block_Adminhtml_Renderer_Imageshow
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
		// Zend_Debug::dump($row->getPath());die();
        $val = Mage::getBaseUrl('media').$row->getPath();
        $out = "<img src=". $val ." width='97px'/>";
        return $out;
	}

}
 ?>
