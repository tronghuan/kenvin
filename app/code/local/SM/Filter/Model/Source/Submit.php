<?php
class SM_Filter_Model_Source_Submit
{

    const SUBMIT_AUTO_DELAYED = 1;
    const SUBMIT_BUTTON = 2;

    protected $_options;

    public function toOptionArray()
    {
        if (null === $this->_options) {
            $helper = Mage::helper('sm_filter');
            $this->_options = array(
                self::SUBMIT_AUTO_DELAYED => $helper->__('Delayed auto submit'),
                self::SUBMIT_BUTTON => $helper->__('Submit button')
            );
        }

        return $this->_options;
    }

}