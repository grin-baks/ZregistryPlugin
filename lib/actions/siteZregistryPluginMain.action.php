<?php

/**
* This class displays the main content in the frontend
*/

class siteZregistryPluginMainAction extends waViewAction
{

	public function execute()
	{
	$model = new siteZregistryPluginCarlistModel();
	$this->view->assign('cars', $model->getCars(false));
	$this->view->assign('urlToPhote', wa()->getConfig()->getRootUrl(true) . 'wa-data/public/site/photocar/');
	}
}