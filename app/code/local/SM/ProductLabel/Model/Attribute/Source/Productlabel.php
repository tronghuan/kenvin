<?php
class SM_ProductLabel_Model_Attribute_Source_ProductLabel extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function toOptionArray()
    {
        return $this->getAllOptions();
    }

    public function getAllOptions()
    {
        if(is_null($this->_options))
        {
            $this->_options = array();

            $collection = 
                Mage::getModel('sm_productlabel/label')->getCollection();

            foreach($collection as $label)
            {
                switch($label->getData('positional')){
                    case 1:
                        $position = 'Top Left';
                        break;
                    case 2:
                        $position = 'Top Right';
                        break;
                    case 3:
                        $position = 'Bottom Left';
                        break;
                    case 4:
                        $position = 'Bottom Right';
                        break;
                    default:
                        $position = 'Bottom Right';
                        break;
                }
                $this->_options[]= array(
                    'label' => $label->getData('name').' - '.$position,
                    'value' => $label->getData('label_id')
                );
            }
        }

        return $this->_options;
    }
}