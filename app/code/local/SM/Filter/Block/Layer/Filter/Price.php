<?php
class SM_Filter_Block_Layer_Filter_Price 
    extends Mage_Catalog_Block_Layer_Filter_Price
{

    protected function _prepareFilter()
    {
        $helper = Mage::helper('sm_filter');
        if ($helper->isPriceSliderEnabled()) {
            $this->setTemplate('sm/filter/catalog/layer/filter/price.phtml');
        }
        return parent::_prepareFilter();
    }

    public function getMaxPriceFloat()
    {
        return $this->_filter->getMaxPriceFloat();
    }

    public function getMinPriceFloat()
    {
        return $this->_filter->getMinPriceFloat();
    }

    public function getCurrentMinPriceFilter()
    {
        list($from, $to) = $this->_filter->getInterval();
        $from = floor((float) $from);

        if ($from < $this->getMinPriceFloat()) {
            return $this->getMinPriceFloat();
        }

        return $from;
    }

    public function getCurrentMaxPriceFilter()
    {
        list($from, $to) = $this->_filter->getInterval();
        $to = floor((float) $to);

        if ($to == 0 || $to > $this->getMaxPriceFloat()) {
            return $this->getMaxPriceFloat();
        }

        return $to;
    }

    public function getUrlPattern()
    {
        $item = Mage::getModel('catalog/layer_filter_item')
            ->setFilter($this->_filter)
            ->setValue('__PRICE_VALUE__')
            ->setCount(0);

        return $item->getUrl();
    }

    public function isSubmitTypeButton()
    {
        $type = $this->helper('sm_filter')->getPriceSliderSubmitType();

        if ($type == SM_Filter_Model_Source_Submit::SUBMIT_BUTTON) {
            return true;
        }

        return false;
    }

    public function getItemsCount()
    {
        if ($this->helper('sm_filter')->isPriceSliderEnabled()) {
            return 1; // Keep price filter ON
        }

        return parent::getItemsCount();
    }

}
