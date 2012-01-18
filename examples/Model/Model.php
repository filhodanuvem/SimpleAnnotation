<?php

namespace Model;
use SimpleAnnotation as annot;

class Model 
{
	protected $status;
	public function save()
	{
		$annot = new annot\Annotation($this);
		$annot->filter();
		$this->status = $annot->getStatus();
		
	}
}