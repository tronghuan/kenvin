<?php
/**
 * Catalog layered navigation view block
 *
 * @package     SM_Filter
 * @author      HuanDT
 */
class SM_Filter_Block_Layer_View 
	extends Mage_Catalog_Block_Layer_View
{
    /**
     * @return Mage_Catalog_Block_Layer_View|Mage_Core_Block_Abstract
     *
     * Viet lai ham _prepareLayout de dua ra layout theo yeu cau
     */
    protected function _prepareLayout()
	{
	    $stateBlock = $this->getLayout()->createBlock($this->_stateBlockName)
	        ->setLayer($this->getLayer());

	    $categoryBlock = $this->getLayout()->createBlock($this->_categoryBlockName)
	        ->setLayer($this->getLayer())
	        ->init();

	    $this->setChild('layer_state', $stateBlock);
	    $this->setChild('category_filter', $categoryBlock);

	    $filterableAttributes = $this->_getFilterableAttributes();
	    foreach ($filterableAttributes as $attribute) {
	        if ($attribute->getAttributeCode() == 'price') {
	            $filterBlockName = $this->_priceFilterBlockName;
	        } elseif ($attribute->getBackendType() == 'decimal') {
	            $filterBlockName = $this->_decimalFilterBlockName;
	        } else {
	            $filterBlockName = $this->_attributeFilterBlockName;
	        }

            // Lay template tuong ung dua theo Model_Source_Navigation
            $this->setChild($attribute->getAttributeCode() . '_filter',
                $this->getLayout()->createBlock($filterBlockName)
                    ->setLayer($this->getLayer())
                    ->setAttributeModel($attribute)
                    ->setTemplate(SM_Filter_Model_Source_Navigation::getTemplateFile($attribute->getNavigationDisplay()))
                    ->init());
	    }

	    $this->getLayer()->apply();

	    return Mage_Core_Block_Template::_prepareLayout();
	}
}
