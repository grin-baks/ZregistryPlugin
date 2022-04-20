<?php

/**
* This class manages interaction with the 'site_zregistry_carlist' database table
*/

class siteZregistryPluginCarlistModel extends waModel
{

    protected $table = 'site_zregistry_carlist';



	/**
	* @param bool $mode true to return unmoderated values otherwise return moderated values
	*
	* @param int $limit
	*
	* @return array
	*/
	public function getCars($mode = true, $limit = 100)
    {
		$dataQuery = [
		'mode' => $mode ? "=" : "!=",
		'limit' => $limit,
		];
		$carList = $this->query(
		"SELECT * FROM ".$this->table." WHERE `status` l:mode 'moderation' ORDER BY date DESC LIMIT i:limit", $dataQuery)->fetchAll('id');
		if(empty($carList)){
		 return [];
		}
		$photosModel = new siteZregistryPluginPhotosModel();
		$photoList = $photosModel->getPhotoByCarid(array_keys($carList));

		foreach($carList as $id_car => $line){
			if(!empty($photoList[$id_car])){
				$carList[$id_car]['photos'] = $photoList[$id_car];
			}
			else{
				$carList[$id_car]['photos'] = [];
			}
		}
		
		return $carList;
	}



	/**
	* Marks posts as being moderated
	*
	* @param array $carId one-dimensional array car ID
	*
	*/
	public function allow($carId)
	{
		foreach($carId as $id){
			$this->updateById($id, ['status' => 'allow']);
		}
	}



	/**
	* Deleting vehicle information including images
	*
	* @param array $carIds one-dimensional array of identifiers
	*/
	public function delete($carIds)
	{
		$condition = '';
		$countCar = count($carIds);
		foreach($carIds as $id){
			$condition .= "id = $id";
			$countCar--;
			if(0 !== $countCar){
			$condition .= ' OR ';
			}
		}
	$this->exec("DELETE FROM ".$this->table." WHERE " . $condition);
	$photosModel = new siteZregistryPluginPhotosModel();
	$photosModel->delete($carIds);
	}
}