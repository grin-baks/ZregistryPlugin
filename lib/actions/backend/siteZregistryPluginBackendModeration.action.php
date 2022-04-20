 <?php

/**
* This is an action class that displays the moderation page in the backend
*/

class siteZregistryPluginBackendModerationAction  extends waViewAction
{
	public function execute()
	{
	$model = new siteZregistryPluginCarlistModel();
	$this->view->assign('cars', $model->getCars());
	$this->view->assign('urlToPhote', wa()->getConfig()->getRootUrl(true) . 'wa-data/public/site/photocar/');
	}
}