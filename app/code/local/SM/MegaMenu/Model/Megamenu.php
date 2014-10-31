<?php
/**
*
*/
class SM_MegaMenu_Model_Megamenu
    extends Mage_Core_Model_Abstract
{

	const TYPE_CATEGORY = 'category';
	const TYPE_STATIC_BLOCK = 'static_block';

    protected function _construct()
    {
    	parent::_construct();
        $this->_init('sm_megamenu/megamenu');
    }

    protected function _beforeSave()
    {
    	$data = $this->getData();
    	switch ($data['type']) {
    		case self::TYPE_CATEGORY:
    			$this->setData('type_value', $data['category_select']);
    			break;

    		case self::TYPE_STATIC_BLOCK:
    			$this->setData('type_value', $data['static_block_select']);
    			break;
    		
    		default:
    			
    			break;
    	}
    	return parent::_beforeSave();
    }
}
 ?>
