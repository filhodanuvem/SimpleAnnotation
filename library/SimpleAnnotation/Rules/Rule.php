<?php

/**
* @author Claudson Oliveira
*
* Interface used to rules 
*
*/ 

namespace SimpleAnnotation\Rules;
use SimpleAnnotation\Annotation;

interface Rule 
{
	public function execute(Annotation $obj);
	
}
