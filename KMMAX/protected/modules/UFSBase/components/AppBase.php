<?php

/** 
 * Base generic controller class
 * 
 * @package UFS.controllers
 */
abstract class AppBase extends CController {

	/**
	 * Renders a view file.
	 * Overrides {@link CBaseController::renderFile} to check if the requested view 
	 * has a version in /custom, and uses that if it exists.
	 *
	 * @param string $viewFile view file path
	 * @param array $data data to be extracted and made available to the view
	 * @param boolean $return whether the rendering result should be returned instead of being echoed
	 * @return string the rendering result. Null if the rendering result is not required.
	 * @throws CException if the view file does not exist
	 */
	public function renderFile($viewFile,$data=null,$return=false) {
		$viewFile = Yii::getCustomPath($viewFile);
		return parent::renderFile($viewFile,$data,$return);
	}
}
?>