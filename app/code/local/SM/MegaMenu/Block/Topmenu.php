<?php 
/**
* 
*/
class SM_MegaMenu_Block_Topmenu
	extends Mage_Page_Block_Html_Topmenu
{
	/**
	 * Get top menu html
	 *
	 * @param string $outermostClass
	 * @param string $childrenWrapClass
	 * @return string
	 */
	public function getHtml($outermostClass = '', $childrenWrapClass = '')
	{
		if (!Mage::getStoreConfig('sm_megamenu/general/enable')) {
		    Mage::dispatchEvent('page_block_html_topmenu_gethtml_before', array(
		        'menu' => $this->_menu,
		        'block' => $this
		    ));
		} else {
			$this->_beforeGetHtml();
		}
		

	    $this->_menu->setOutermostClass($outermostClass);
	    $this->_menu->setChildrenWrapClass($childrenWrapClass);

	    if ($renderer = $this->getChild('catalog.topnav.renderer')) {
	        $renderer->setMenuTree($this->_menu)->setChildrenWrapClass($childrenWrapClass);
	        $html = $renderer->toHtml();
	    } else {
	        $html = $this->_getHtml($this->_menu, $childrenWrapClass);
	    }

	    Mage::dispatchEvent('page_block_html_topmenu_gethtml_after', array(
	        'menu' => $this->_menu,
	        'html' => $html
	    ));

	    return $html;
	}

	protected function _beforeGetHtml()
	{

	    $menu = $this->_menu;
	    $tree = $menu->getTree();

	    $collection = $this->_getCollection();

	    foreach ($collection as $item) {

	   		if ($item->getType() == 'category') {
	   			/* @var Mage_Catalog_Model_Category */
	   			$_catURL = Mage::getModel('catalog/category')
	   				->load($item->getTypeValue())
	   				->getUrl();
	   			$node = new Varien_Data_Tree_Node(array(
	   			        'name'   => $item->getName(),
	   			        'id'     => 'categories-'.$item->getId(),
	   			        'url'    =>  $_catURL, // point somewhere
	   			), 'id', $tree, $menu);
	   			$menu->addChild($node);
	   			$this->_getChildNodeById($item->getTypeValue(), $node);


	   		}
	   		if ($item->getType() == 'static_block') {
	   			$node = new Varien_Data_Tree_Node(array(
	   			        'name'   => $item->getName(),
	   			        'id'     => 'categories-'.$item->getId(),
	   			        'is_block' => true,
	   			        'block_id' => $item->getTypeValue(),
	   			        'url'    => '#', // point somewhere
	   			), 'id', $tree, $menu);

	   			$menu->addChild($node);

	   		}

	   }
	
	}

	protected function _getCollection()
	{
		$collection = Mage::getModel('sm_megamenu/megamenu')
			->getCollection()
			->setOrder('sort_order', 'ASC')
			->addFieldToFilter('is_active', 1);
		return $collection;
	}

	protected function _getChildNodeById($id, &$parentNode)
	{
		$items = Mage::getResourceModel('catalog/category_collection')
			->setStore(Mage::app()->getStore())
			->addIsActiveFilter()
			->addNameToResult()
			->addAttributeToFilter('parent_id', $id);
			
		$tree = $parentNode->getTree();
		
		foreach ($items as $item) {

			$node = new Varien_Data_Tree_Node(array(
			        'name'   => $item->getName(),
			        'id'     => 'categories-'.$item->getId(),
			        'url'    => $item->getUrl(), // point somewhere
			), 'id', $tree, $parentNode);
			$parentNode->addChild($node);

			if ($item->hasChildren()) {
				$this->_getChildNodeById($item->getId(), $node);
			}
		}
	}

}
 ?>