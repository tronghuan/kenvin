<?php 
/**
* 
*/
class SM_Slider_Adminhtml_Sm_Slider_SliderController
	 extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->_title($this->__('Manage Slider'));
		$this->loadLayout();
		$this->_setActiveMenu('sm_base');
		$this->renderLayout();
		// die(__METHOD__);
	}

	public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
	{
		$id = $this->getRequest()->getParam('id', null);
		$model = Mage::getModel('sm_slider/slider');
		if ($id) {
			# edit action
			$model->load((int)$id);
			if ($model->getId()) {
				# code...
				// Mage_Adminhtml_Model_Session
				$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
				if ($data) {
					$model->setData($data)->setId($id);
				}
			} else {
				# id not exist
				Mage::getSingleton('adminhtml/session')
					->addError('Slider does not exist');
				$this->_redirect('*/*/');
			}
		}
		Mage::register('slider_data', $model);
		$this->_title($this->__('Slider'))
			->_title($this->__('Edit slider'));
		$this->loadLayout();
		$this->renderLayout();
	}
	public function saveAction()
	{
		if ($data = $this->getRequest()->getPost()) {
			# process data
			$model = Mage::getModel('sm_slider/slider');
			$id = $this->getRequest()->getParam('id');

			if ($id) {
				$model->load($id);
			}
			$model->setData($data);
			Mage::getSingleton('adminhtml/session')
				->setFormData($data);
			try {
				if ($id) {
					$model->setId($id);
				}
				$model->save();
				if (!$model->getId()) {
					Mage::throwException(Mage::helper('sm_slider')
						->__('Error saving Slider'));
				}
				Mage::getSingleton('adminhtml/session')
					->addSuccess(Mage::helper('sm_slider')
						->__('Slider was successfully saved.'));
				Mage::getSingleton('adminhtml/session')
					->setFormData(false);
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')
					->addError($e->getMessage());
				if ($model && $model->getId()) {
					$this->_redirect('*/*/edit');
				} else {
					$this->_redirect('*/*/');
				}
			}
			return;
		}
		// Error
		Mage::getSingleton('adminhtml/session')
			->addError(Mage::helper('sm_slider')->__('No data found to save'));
		$this->_redirect('*/*/');
	}
}

 ?>