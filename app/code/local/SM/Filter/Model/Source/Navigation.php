<?php 
/**
* 
*/
class SM_Filter_Model_Source_Navigation
{
	const TYPE_CHECKBOX = 1;
	const TYPE_LINK = 2;
	const TYPE_SELECT = 3;
	const TYPE_COLOR = 4;

	const TEMPLATE_PATH = 'sm/filter/catalog/layer/filter/';
	const TEMPLATE_DEFAULT = 'sm/filter/catalog/layer/filter/link.phtml';
	protected static $_options;
	public static function toOptionArray()
	{
		if (!self::$_options) {
			self::$_options = array(
				array('value' => '', 
					'label' => Mage::helper('catalog')->__('Default'),
				),
				array('value' => self::TYPE_CHECKBOX, 
					'label' => Mage::helper('catalog')->__('Checkbox'),
				),
				array('value' => self::TYPE_LINK, 
					'label' => Mage::helper('catalog')->__('Link'),
				),
				array('value' => self::TYPE_SELECT, 
					'label' => Mage::helper('catalog')->__('Select'),
				),
				array('value' => self::TYPE_COLOR, 
					'label' => Mage::helper('catalog')->__('Color'),
				)
			);
		}
		return self::$_options;
	}

	public static function getTemplateFile($type)
	{
		switch ($type) {
			case self::TYPE_CHECKBOX:
				return self::TEMPLATE_PATH . 'checkbox.phtml';
				break;
			case self::TYPE_LINK:
				return self::TEMPLATE_PATH . 'link.phtml';
				break;
			case self::TYPE_SELECT:
				return self::TEMPLATE_PATH . 'select.phtml';
				break;
			case self::TYPE_COLOR:
				return self::TEMPLATE_PATH . 'color.phtml';
				break;
			default:
				return self::TEMPLATE_DEFAULT;
				break;
		}
	}
}
 ?>