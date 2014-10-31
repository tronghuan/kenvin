<?php

/**
 * Class SM_Filter_Model_Catalog_Layer_Filter_Attribute
 * @author HuanDT
 */
class SM_Filter_Model_Catalog_Layer_Filter_Attribute 
    extends Mage_Catalog_Model_Layer_Filter_Attribute
{
    protected $_values = array();
    
    public function getValues()
    {
        return $this->_values;
    }
    
    public function apply(Zend_Controller_Request_Abstract $request, $filterBlock)
    {
        $filter = $request->getParam($this->_requestVar);
        if (is_array($filter)) {
            return $this;
        }
        if (empty($filter)) {
            return $this;
        }
        $this->_values = explode(',', $filter);
        foreach ($this->_values as $value) {
            $text = $this->_getOptionText($value);
            if (strlen($text)) {
                $this->getLayer()->getState()->addFilter($this->_createItem($text, $value));
            }
        }
        if (!empty($this->_values)) {
            $this->_getResource()->applyFilterToCollection($this, $this->_values);
        }
        return $this;
    }
    
}
