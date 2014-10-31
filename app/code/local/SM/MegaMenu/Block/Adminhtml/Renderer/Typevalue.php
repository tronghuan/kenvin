<?php
/**
*
*/
class SM_MegaMenu_Block_Adminhtml_Renderer_Typevalue
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{

        $id = $row->getTypeValue();
        $value = '';
        switch ($row->getData('type')) {
            case SM_MegaMenu_Model_Megamenu::TYPE_CATEGORY:
                $value .= Mage::getModel('catalog/category')->load($id)->getName();
                break;

            case SM_MegaMenu_Model_Megamenu::TYPE_STATIC_BLOCK:
                $value .= Mage::getModel('cms/block')->load($id)->getTitle();
                break;

            default:
                # code...
                break;
        }

        return $value;

	}

}
 ?>
