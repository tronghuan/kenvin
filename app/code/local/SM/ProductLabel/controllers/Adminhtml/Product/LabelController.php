<?php

class SM_ProductLabel_Adminhtml_Product_LabelController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('sm_base/sm_productlabel/image')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Product Label Manager'), Mage::helper('adminhtml')->__('Product Label Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}
	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('sm_productlabel/label')->load($id);
		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}
			Mage::register('productlabel_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('productlabel/productlabel');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Product Label Manager'), Mage::helper('adminhtml')->__('Product Label Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Product Label News'), Mage::helper('adminhtml')->__('Product Label News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('sm_productlabel/adminhtml_productlabel_edit'))
				->_addLeft($this->getLayout()->createBlock('sm_productlabel/adminhtml_productlabel_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sm_productlabel')->__('Product Label does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}

	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			if(isset($_FILES['imagename']['name']) && $_FILES['imagename']['name'] != '') {
				try {	
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('imagename');
					
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					
					$uploader->setFilesDispersion(false);
					
					$_FILES['imagename']['name']=time();
					// We set media as the upload dir
					$path = Mage::getBaseDir('media') . DS."SM". DS . "ProductLabel" . DS . "images" . DS;
					$uploader->save($path, $_FILES['imagename']['name'] );
					
				} catch (Exception $e) {
		      
		        }
	        
		        //this way the name is saved in DB
	  			$data['imagename'] = $_FILES['imagename']['name'];
			}
			$model = Mage::getModel('sm_productlabel/label');

			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			try {
				$model->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sm_productlabel')->__('Product Label was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slider')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('sm_productlabel/label');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Product Label was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}
    public function massDeleteAction() {
        $labelIds = (array)$this->getRequest()->getParam('label_id');
        if(!is_array($labelIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($labelIds as $labelid) {
                    $megamenu = Mage::getModel('sm_productlabel/label')->load($labelid);
                    $megamenu->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($labelIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}