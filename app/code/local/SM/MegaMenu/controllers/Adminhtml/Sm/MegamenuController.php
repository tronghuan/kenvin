<?php
/**
*
*/
class SM_MegaMenu_Adminhtml_Sm_MegamenuController
	extends Mage_Adminhtml_Controller_Action
{

	public function indexAction()
	{
		$this->loadLayout();
		$this->_setActiveMenu('sm_base');
		$this->renderLayout();
	}
	public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
	{
		$id = $this->getRequest()->getParam('id', null);
		$model = Mage::getModel('sm_megamenu/megamenu');
		if ($id) {
			# edit action
			$model->load((int)$id);
			if ($model->getId()) {
				// Mage_Adminhtml_Model_Session
				$data = Mage::getSingleton('adminhtml/session')->getFormData(true);

				if ($data) {
					$model->setData($data)->setId($id);
				} else {
					$model->setData($this->_processDataToEdit($model->getData()));
				}
			} else {
				# id not exist
				Mage::getSingleton('adminhtml/session')
					->addError('Mega Menu does not exist');
				$this->_redirect('*/*/');
			}
		}
		Mage::register('megamenu_data', $model);
		$this->_title($this->__('Mega Menu'))
			->_title($this->__('Edit Mega Menu'));
		$this->loadLayout();
		$this->renderLayout();
	}

	public function saveAction()
	{
		if ($data = $this->getRequest()->getPost()) {
			$model = Mage::getModel('sm_megamenu/megamenu');
			$id = $this->getRequest()->getParam('id');

			if ($id) {
				$model->load($id);
			}
			$model->setData($data);

			Mage::getSingleton('adminhtml/session')->setFormData($data);

			try {
				if ($id) {
					$model->setId($id);
				}
				$model->save();
				if (!$model->getId()) {
					Mage::throwException(Mage::helper('sm_megamenu')->__('Error saving Mega Menu'));
				}
				Mage::getSingleton('adminhtml/session')
					->addSuccess(Mage::helper('sm_megamenu')->__('Mage Menu was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				if ($model && $model->getId()) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
				} else {
					$this->_redirect('*/*/');
				}
			}

			return;
		}
		Mage::getSingleton('adminhtml/session')
			->addError(Mage::helper('sm_megamenu')->__('No data found to save'));
		$this->_redirect('*/*/');
	}

	public function deleteAction()
	{
		if ($id = $this->getRequest()->getParam('id')) {
			try {
				$model = Mage::getModel('sm_megamenu/megamenu');
				$model->setId($id);
				$model->delete();
				Mage::getSingleton('adminhtml/session')
					->addSuccess(Mage::helper('sm_megamenu')
						->__('The Mega Menu had been deleted.'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')
					->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id'=>$id));
			}
			return;
		}
		Mage::getSingleton('adminhtml/session')
			->addError(Mage::helper('sm_megamenu')
				->__('Unable to find the Mage Menu to delete'));
		$this->_redirect('*/*/');
	}

	// protected function _processDataToSave(&$data)
	// {
		// switch ($data['type']) {
		// 	case 'category':
		// 		$data['type_value'] = $data['category_select'];
		// 		break;

		// 	case 'static_block':
		// 		$data['type_value'] = $data['static_block_select'];
		// 		break;

		// 	default:

		// 		break;
		// }
	// }

	protected function _processDataToEdit($data)
	{
		switch ($data['type']) {
			case 'category':
				$data['category_select'] = $data['type_value'];
				break;

			case 'static_block':
				$data['static_block_select'] = $data['type_value'];
				break;

			default:

				break;
		}
		return $data;
	}
}
