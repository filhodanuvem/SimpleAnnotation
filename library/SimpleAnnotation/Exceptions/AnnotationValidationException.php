<?php

namespace SimpleAnnotation\Exceptions;
class AnnotationValidationException extends \RangeException implements AnnotationException 
{
    protected $status;
    protected $props;
    public function __construct($target,Array $props,Array $status)
    {
        $this->status = $status;
        $this->props  = $props;
        $key = array_search(false,$this->status);
        $method = 'get'.ucfirst($key);
        parent::__construct('Attribute "'.$key.'" of class "'.get_class($target).'" needs be a '.$props[$key]['validate'].' type, this value is a '.gettype($target->$method()));
    }
    
   
    
    
    
}
