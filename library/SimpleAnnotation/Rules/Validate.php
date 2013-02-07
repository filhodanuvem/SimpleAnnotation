<?php

namespace SimpleAnnotation\Rules;
use SimpleAnnotation\Annotation; 
use SimpleAnnotation\Exceptions\AnnotationValidationException; 
use Respect\Validation\Validator;

class Validate implements Rule
{
    
    public function execute(Annotation $annot)
    {
        foreach($annot->getProperties() as $attr => $p){
            if($p && array_key_exists('validate',$p)){
                $validator = new Validator();
                try{
                    $validator = $validator->buildRule($p['validate']);
                }catch(Exception $e){
                    continue;
                }
                $access = 'get'.ucfirst($attr);
                $status = $annot->getStatus();
                $status[$attr] = $validator->validate($annot->getTarget()->$access());
            }
        }
        $annot->setStatus($status);
        if(array_search(false,$annot->getStatus(),true))
            throw new AnnotationValidationException($annot->getTarget(),$annot->getProperties(),$annot->getStatus());
        return true;
    }
    
}
