<?php
/**
 * @author Claudson Oliveira
 *
 */
namespace Model;
class Foo extends Model 
{
	/**
	* @validate int
	*/
	protected $value;
	
	public function getValue(){
		return $this->value;
	}
	
	public function setValue($value){
		$this->value = $value;
	}
	
}
