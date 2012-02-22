<?php

namespace SimpleAnnotation\Rules;
use SimpleAnnotation as s; 
use SimpleAnnotation\Exceptions as ex; 
use Respect\Validation          as v;

class Validate
{
    
    public function execute(s\Annotation $annot)
    {
        foreach($annot->getProperties() as $attr => $p){
            if($p && array_key_exists('validate',$p)){
                $validator = new v\Validator();
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
            throw new ex\AnnotationValidationException($annot->getTarget(),$annot->getProperties(),$annot->getStatus());
        return true;
    }
    
}
