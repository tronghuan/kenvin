<?php 
/**
* 
*/
require_once(Mage::getModuleDir('controllers','Mage_Adminhtml').DS.'Catalog'.DS.'ProductController.php');
class SM_Featured_Adminhtml_Catalog_ProductController 
	extends Mage_Adminhtml_Catalog_ProductController
{
	/**
	 * Update product(s) featured action
	 *
	 */
	public function massFeaturedAction()
	{
	    $productIds = (array)$this->getRequest()->getParam('product');
	    $storeId    = (int)$this->getRequest()->getParam('store', 0);
	    $status     = (int)$this->getRequest()->getParam('status');

	    try {
	        Mage::getSingleton('catalog/product_action')
	            ->updateAttributes($productIds, array('is_featured' => $status), $storeId);

	        $this->_getSession()->addSuccess(
	            $this->__('Total of %d record(s) have been updated.', count($productIds))
	        );
	    }
	    catch (Mage_Core_Model_Exception $e) {
	        $this->_getSession()->addError($e->getMessage());
	    } catch (Mage_Core_Exception $e) {
	        $this->_getSession()->addError($e->getMessage());
	    } catch (Exception $e) {
	        $this->_getSession()
	            ->addException($e, $this->__('An error occurred while updating the product(s) status.'));
	    }

	    $this->_redirect('*/*/', array('store'=> $storeId));
	}


}
 ?>