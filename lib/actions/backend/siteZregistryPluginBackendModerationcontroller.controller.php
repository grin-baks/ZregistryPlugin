 <?php

/**
* This controller class accepts ajax requests from the moderation page and processes them
*/

class siteZregistryPluginBackendModerationcontrollerController  extends waController
{
	
	public function execute()
	{
		$mode = waRequest::post('mode', '');
		$data = waRequest::post('data', '');
		
		if(empty($mode) || empty($data)){
			return;
		}
		$data = json_decode($data);
		$listModel = new siteZregistryPluginCarlistModel();	
		if($mode === 'delete'){
		$listModel->delete($data);
		}
		elseif($mode === 'allow'){
		$listModel->allow($data);
		}
	}
}