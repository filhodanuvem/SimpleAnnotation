<?php

namespace SimpleAnnotation\Exceptions;
class AnnotationValidationException extends \RangeException implements AnnotationException 
{
    protected $status;
    public function __construct(Array $status)
    {
        $this->status = $status;
        $key = array_search(false,$this->status);
        parent::__construct('Attribute "'.$key.'" is not setted');
    }
    
   
    
    
    
}
