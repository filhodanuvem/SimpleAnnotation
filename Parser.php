<?php
/**
* Class that represents a parser. It reads a comment block and generate 
* a associative array. 
* 
* @author Claudson Oliveira
*
*/
namespace SimpleAnnotation;

class Parser
{
	
	public function __construct()
	{
		
	}
	
    public function read($text)
    {
       $lines = preg_split('/\n/',$text);
       $lines = array_map(function($value){
       		$pos = strpos($value, '@');
       		return ($pos === false)?null:substr($value, $pos);
       },$lines);
	   $lines = array_filter($lines,function($value){
	   		return (strpos($value,'@')!==false);
	   });
       
	   $props = array();
       foreach($lines as $l){
       	  $foo = explode(' ',$l);
       	  $props[substr(trim($foo[0]),1)] = (count($foo) > 1)?$foo[1]:null;
       }
       return $props;
    }
}
