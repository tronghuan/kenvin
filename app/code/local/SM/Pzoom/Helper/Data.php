<?php
/**
*
*/
class SM_Pzoom_Helper_Data
    extends Mage_Core_Helper_Abstract
{
	const THUMBNAIL_IMAGE_SIZE = 75;

	protected function getSizeConfig($path)
	{
		if (($cf = (int) Mage::getStoreConfig('sm_pzoom/' . $path)) > 0)
		{
			return $cf;
		}
		return false;
	}

	public function getMainImageWidth()
	{
		return $this->getSizeConfig('main_image/width');
	}

	public function getMainImageHeight()
	{
		return $this->getSizeConfig('main_image/heigth');
	}

	public function getBoxZoomImageWidth()
	{
		return $this->getSizeConfig('box_zoom_image/width');
	}

	public function getBoxZoomImageHeight()
	{
		return $this->getSizeConfig('box_zoom_image/height');
	}

	public function getThumbnailImageWidth()
	{
		$size = $this->getSizeConfig('thumbnail_image/width');
		if ($size) {
			return $size;
		}
		return self::THUMBNAIL_IMAGE_SIZE;
	}

	public function getThumbnailImageHeight()
	{
		$size = $this->getSizeConfig('thumbnail_image/height');
		if ($size) {
			return $size;
		}
		return self::THUMBNAIL_IMAGE_SIZE;
	}
}

 ?>
