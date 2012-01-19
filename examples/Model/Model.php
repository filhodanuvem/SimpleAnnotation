<?php

namespace Model;
use SimpleAnnotation\Annotation as annot;

class Model 
{
	protected $status;
	public function save()
	{
		$annot = new annot($this);
		$annot->filter();
		$this->status = $annot->getStatus();
		
	}
}
