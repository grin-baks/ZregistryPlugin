<?php

/**
* This controller class handles Ajax requests from the frontend
*/

class siteZregistryPluginPostController extends waController
{

	public function execute()
	{
		if (!wa()->getCaptcha()->isValid()){
			$data['error'] = 1;
			$data['msg'] = 'Incorrect captcha entered. Please check your input and try again';
			echo json_encode($data);
			return;
		}
		$model = new siteZregistryPluginCarlistModel();
		$photesModel = new siteZregistryPluginPhotosModel();		
		$id = $model->insert(
		[
		'car_number' => waRequest::post('car_number'),
		'region_number' => waRequest::post('region_number'),
		'address' => waRequest::post('address'),
		'address_type' => waRequest::post('address_type'),
		'status' => 'moderation',
		]);
		$files = waRequest::file('photo');
		$counter = 1;
		foreach($files as $file) {
			$ext = pathinfo($file->name ,PATHINFO_EXTENSION);
			if(exif_imagetype($file->tmp_name) !== false){
			$fullPath = wa()->getDataPath('photocar/' . waRequest::post('region_number', '000') . '/' . $id . '/', true, 'site') . $counter . '.' . $ext;
			$dbPath = waRequest::post('region_number', '000') . '/' . $id . '/' . $counter . '.' . $ext;
			waFiles::copy($file->tmp_name, $fullPath);
			$photesModel->insert(['id_car' => $id, 'value' => $dbPath]);
			$counter++;
			}
		}
		$data['error'] = 0;
		$data['msg'] = 'The data has been sent. Soon we will check the correctness of the data and place them in an open database. Thank you for your citizenship!';
		echo json_encode($data);
	}
}