<?php

/**
 * @author Claudson Oliveira
 *
 */
namespace Model;
class Bar extends Model {
	/**
	 * 
	 * @validate date
	 */
	protected $date;
	
	public function getDate(){
		return $this->date;
	}
	
	public function setDate($value){
		$this->data = $value;
	}
	
	
}
