<?php

/**
* This class manages interaction with the 'site_zregistry_photos' database table
*/

class siteZregistryPluginPhotosModel extends waModel
{

	protected $table = 'site_zregistry_photos';



	/**
	* Generates a condition string for the request
	*
	* @param array $carId one-dimensional array car ID
	*
	* @return string
	*/
	private function generatesRequest($carId)
	{
		$condition = '';
		$countCar = count($carId);
		foreach($carId as $id_car){
			$condition .= "id_car = $id_car";
			$countCar--;
			if(0 !== $countCar){
			$condition .= ' OR ';
			}
		}	
		
		return $condition;
	}



	/**
	* @param array $carId one-dimensional array car ID
	*
	* @return array
	*/
	public function getPhotoByCarid($carId)
	{
		if(empty($carId)){
			return [];
		}
		$condition = $this->generatesRequest($carId);
		$photoList = $this->query("SELECT  value, id_car FROM ".$this->table." WHERE ". $condition)->fetchAll();
		$returnArr = [];
		foreach($photoList as $photo){
			$returnArr[$photo['id_car']][] = $photo['value'];
		}
		return $returnArr;
	}



	/**
	* Deletes data from the site_zregistry_photos table and also deletes directories and files
	*
	* @param array $carId one-dimensional array car ID
	*
	*/
	public function delete($carId)
	{
		$condition = $this->generatesRequest($carId);
		$photoList = $this->query("SELECT  value, id_car FROM ".$this->table." WHERE ". $condition)->fetchAll('id_car');
		$this->exec("DELETE FROM ".$this->table." WHERE " . $condition);
		foreach($photoList as $photo){
			$this->deleteFile($photo['value']);
		}
	}



	/**
	* Deletes a file and folder. Deletes all photos of the car, having received any one photo of the group
	*
	* @param string $path
	*
	*/
	private function deleteFile($path)
	{
		$pathArr = explode('/',$path);
		$fullPath = wa()->getDataPath('photocar/' . $pathArr[0] . '/' . $pathArr[1] . '/', true, 'site');
		waFiles::delete($fullPath);
	}
}