<?php

/**
 * Enter description here ...
 * @author cloud
 *
 */
namespace Model;
class Bar extends Model {
	/**
	 * 
	 * Enter description here ...
	 * @var date
	 */
	protected $data;
	
	public function getData(){
		return $this->data;
	}
	
	public function setData($value){
		$this->data = $value;
	}
	
	
}