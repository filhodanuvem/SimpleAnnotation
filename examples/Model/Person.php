<?php

namespace Model;

class Person extends Model
{
	/**
	* @var int
	*/
	protected $id;
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var cpf
	 */
	protected $cpf;
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($value){
		$this->id = $value;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function setName($value){
		$this->name = $value;
	}
	
	public function setCpf($value){
		$this->cpf = $value;
	}
	
	public function getCpf(){
		return $this->cpf;
	}	
}
