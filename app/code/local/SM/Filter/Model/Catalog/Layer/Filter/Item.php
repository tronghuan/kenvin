<?php

class SM_Filter_Model_Catalog_Layer_Filter_Item 
    extends Mage_Catalog_Model_Layer_Filter_Item
{

    public function getUrl()
    {

        $values = $this->getFilter()->getValues();
        if (!empty($values)) {
            if (in_array($this->getValue(), $values)) {
                $tmp = array_diff($values, array($this->getValue()));
            } else {
                $tmp = array_merge($values, array($this->getValue()));
            }

            if (empty($tmp)) {
                $values = null;
            } else {
                $values = implode(',', $tmp);
            }
        } else {
            $values = $this->getValue();
        }

        $query = array(
            $this->getFilter()->getRequestVar() => $values,
            Mage::getBlockSingleton('page/html_pager')->getPageVarName() => null // exclude current page from urls
        );
        return Mage::getUrl('*/*/*', array(
            '_current' => true, 
            '_use_rewrite' => true, 
            '_query' => $query,
            '_escape' => false,
            )
        );
    }

    public function getRemoveUrl()
    {
        $values = $this->getFilter()->getValues();
        if (!empty($values)) {
            $tmp = array_diff($values, array($this->getValue()));
            if (!empty($tmp)) {
                $values = $this->getValue();
            } else {
                $values = null;
            }
        } else {
            $values = null;
        }

        $urlParams = array(
            '_current' => true,
            '_use_rewrite' => true,
            '_query' => array($this->getFilter()->getRequestVar() => $values),
            '_escape' => true,
        );
        return Mage::getUrl('*/*/*', $urlParams);

    }

    public function isSelected()
    {
        $values = $this->getFilter()->getValues();
        if (in_array($this->getValue(), $values)) {
            return true;
        }
        return false;
    }
}
