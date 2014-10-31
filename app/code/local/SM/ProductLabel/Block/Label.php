<?php 
/**
* 
*/
class SM_ProductLabel_Block_Label 
	extends Mage_Core_Block_Template
{
	protected $_tag = '<h1>Error. Not set open tag.</h1>';

	protected function _construct()
	{
	    parent::_construct();
	    $this->setTemplate('sm/productlabel/label.phtml');
	}

	public function setOpenTag($tag)
	{
		$classPos = strpos($tag, 'class=');
		if (false === $classPos) {
			$this->_tag = $tag . '<h1>Error. Not set class tag.</h1>';
		} else {
			if (Mage::helper('sm_productlabel')->isProductLabelEnable()) {
				$this->_tag = substr($tag, 0, $classPos + 7) 
					. ' labels-container ' . substr($tag, $classPos + 7);
			} else {
				$this->_tag = $tag;
			}
		}
		return $this;
	}

	public function getOpenTag()
	{
		return $this->_tag;
	}

}
