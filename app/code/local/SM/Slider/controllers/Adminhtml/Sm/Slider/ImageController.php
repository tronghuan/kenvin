<?php
/**
*
*/
class SM_Slider_Adminhtml_Sm_Slider_ImageController
    extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Manage Image Slider'));
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
        $model = Mage::getModel('sm_slider/image');
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
                    ->addError('Image does not exist');
                $this->_redirect('*/*/');
            }
        }
        Mage::register('image_data', $model);
        $this->_title($this->__('Slider'))
            ->_title($this->__('Edit slider'));
        $this->loadLayout();
        $this->renderLayout();
    }
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            # process data

            /*Zend_Debug::dump($data);
            Zend_Debug::dump($_FILES);
            die();*/
            $model = Mage::getModel('sm_slider/image');
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
                $imageFile = $this->_processImageUpload();
                $model->setData('path', $imageFile);
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
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
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

    protected function _processImageUpload()
    {
        if (isset($_FILES['path']['name']) && !empty($_FILES['path']['name'])) {
            $uploader = new Varien_File_Uploader('path');
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);

            $path = Mage::getBaseDir('media').DS.'smslider'.DS.'images'.DS;
            $uploader->save($path, $_FILES['path']['name']);
            return 'smslider'.DS.'images'.DS.$uploader->getUploadedFileName();
        }
        return $this->getRequest()->getPost()['path']['value'];
        /*Mage::throwException(
            Mage::helper('sm_slider')->__('Error processing image file'));*/
    }
}
 ?>
