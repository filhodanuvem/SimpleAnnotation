<?php

namespace Model;
use SimpleAnnotation\Annotation as annot;
use SimpleAnnotation\Exceptions as ex;

class Model 
{
	protected $status;
	public function save() 
	{
		$annot = new annot($this);
		$annot->validate();
		$this->status = $annot->getStatus();
		
	}
}
