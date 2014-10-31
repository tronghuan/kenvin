<?php 
/**
* 
*/
class SM_MegaMenu_Block_Adminhtml_Megamenu_Edit_Tabs_Form
	extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		if (Mage::registry('megamenu_data')) {
			$data = Mage::registry('megamenu_data')->getData();
		} else {
			$data = array();
		}
		// Zend_Debug::dump($data);die();
		
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('megamenu_form', array(
			'legend' => Mage::helper('sm_megamenu')->__('Mega Menu Infomation')
			));
		$fieldset->addField('name', 'text', array(
			'label' => Mage::helper('sm_megamenu')->__('Mega Menu Name'),
			'class' => 'required-entity',
			'required' => true,
			'name' => 'name'
			));
		$fieldset->addField('is_active', 'select', array(
			'label' => Mage::helper('sm_megamenu')->__('Active'),
			'class' => 'required-entity',
			'required' => true,
			'name' => 'is_active',
			'values' => array(
				0 => 'No',
				1 => 'Yes'
				),
			));
		$fieldset->addField('sort_order', 'text', array(
			'label' => Mage::helper('sm_megamenu')->__('Sort order'),
			'class' => 'required-entity  validate-number',
			'required' => true,
			'name' => 'sort_order',
			));
		$type = $fieldset->addField('type', 'select', array(
			'label' => Mage::helper('sm_megamenu')->__('Mega Menu Type'),
			'class' => 'required-entity',
			'required' => true,
			'name' => 'type',
			'values' => array(
				'category' => 'Category',
				'static_block' => 'Static Block'
				)
			));
		$categorySelect = $fieldset->addField('category_select', 'select', array(
			'label' => Mage::helper('sm_megamenu')->__('Select category'),
			'class' => 'required-entity',
			'required' => true,
			'name' => 'category_select',
			'values' => $this->_getCategories()
			));
		$staticBlockSelect = $fieldset->addField('static_block_select', 'select', array(
			'label' => Mage::helper('sm_megamenu')->__('Select Static Block'),
			'class' => 'required-entity',
			'required' => true,
			'name' => 'static_block_select',
			'values' => Mage::getModel('cms/block')->getCollection()->toOptionArray()
			));

		$this->setChild('form_after', $this->getLayout()
			->createBlock('adminhtml/widget_form_element_dependence')
            ->addFieldMap($type->getHtmlId(), $type->getName())
            ->addFieldMap($categorySelect->getHtmlId(), $categorySelect->getName())
            ->addFieldMap($staticBlockSelect->getHtmlId(), $staticBlockSelect->getName())
            ->addFieldDependence(
                $staticBlockSelect->getName(),
                $type->getName(),
                'static_block'
            )
            ->addFieldDependence(
                $categorySelect->getName(),
                $type->getName(),
                'category'
            )
        );

        $form->setValues($data);
       /* $product1Link = $fieldset->addField('product1_link', 'label', array(
                'name' => 'product1_link',
                'label' => Mage::helper('sm_megamenu')->__('Product 1'),
                'class' => 'widget-option',
                'value' => $model->getProduct1Link(),
                'required' => true,
            ));

        $model->unsProduct1Link();
        $helperBlock = $this->getLayout()->createBlock('adminhtml/catalog_product_widget_chooser');
        if ($helperBlock instanceof Varien_Object) {
            $helperBlock->setConfig(array(
            	'input_name'  => 'entity_link',
        	    'input_label' => $this->__('Product'),
        	    'button_text' => $this->__('Select Product...'),
        	    'required'    => true,
            	))
                ->setFieldsetId($fieldset->getId())
                ->setTranslationHelper(Mage::helper('sm_megamenu'))
                ->prepareElementHtml($product1Link);
        }
*/
		return parent::_prepareForm();
	}

	protected function _getCategories(){

	    $category = Mage::getModel('catalog/category'); 
	    $tree = $category->getTreeModel(); 
	    $tree->load();
	    $ids = $tree->getCollection()->getAllIds(); 
	    $arr = array();
	    if ($ids){ 
	    foreach ($ids as $id){ 
	    $cat = Mage::getModel('catalog/category'); 
	    $cat->load($id);
	    $arr[$id] = $cat->getName();
	    } 
	    }

	    return $arr;

	}

	
}
 ?>