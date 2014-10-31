<?php
/**
*
*/
class SM_Slider_Block_Adminhtml_Renderer_Slider
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{

        $id = $row->getSliderId();
        return Mage::getModel('sm_slider/slider')->load($id)->getName();

	}

}
 ?>
