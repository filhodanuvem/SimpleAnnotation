<?php
/**
* Class that group all annotations of the one object
* 
* @author Claudson Oliveira
*
*/
namespace SimpleAnnotation ;
class Annotation
{
    protected $reflection; 
    protected $properties;
    protected $parser;
    protected $target ; 
    protected $status;
    protected $blocks;
    /**
    * @var Cache
    */
    protected $cache ;
    public function __construct($target)
    {
        $this->target     = $target ;
        $this->parser     = new Parser(); 
        $this->reflection = new \ReflectionClass($target);
        $this->blocks     = $this->getAllDocs();
        $this->cache      = new Cache();
        $c = $this->cache->getCacheBlock($this);
        $this->properties = unserialize($this->cache->getCache($this));
        if($c != $this->getHashBlock() ){
        	$this->properties = $this->execute();
        	$this->cache->setCache($this);
        } 
    }
    
    /**
     * 
     * Create a array with all comments blocks 
     */
    private function getAllDocs()
    {
    	$props = $this->reflection->getProperties();
    	$blocks = array();
    	foreach($props as $p){
    		$propReflect = new \ReflectionProperty($p->class,$p->name);
    		$blocks[$p->name] = $propReflect->getDocComment();
    	}
    	return $blocks;
    }
    
    public function execute()
    {
    	$this->properties = array();
    	foreach($this->blocks as $name => $block){
    		$this->properties[$name] = $this->parser->read($block);
    	}
    	return $this->properties;
    }
    
    public function __call($name,$attr)
    {
        $name = 'SimpleAnnotation\Rules\\'.ucfirst($name);
        if(!class_exists($name))
            throw new BadMethodCallException("Method {$name} not found! ");
        $rule = new $name ;
        return $rule->execute($this);
    }
    /* utils */
    public function getHash()
    {
    	return str_replace(' ', '',serialize($this->properties));
    }
    
    public function getHashBlock()
    {
    	return str_replace(' ', '',serialize($this->blocks));
    }
    
    public function setStatus(Array $status)
    {
        $this->status = $status;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function getNameTarget()
    {
    	return $this->reflection->getName();
    }
    
    public function getProperties()
    {
        return $this->properties;
    }
    
    public function getTarget()
    {
        return $this->target;
    }
    
    /*metaprogrammer*/
    
    /**
     *  get all annotations from attribute $attr 
     */ 
    public function getAnnotationsFrom($attr)
    {
		if(!isset($this->properties[$attr]))
			return null;
			
		return $this->properties[$attr];
	}
	
	
    /**
     *  get all attributes with certain annotations
     */  
    public function getAtributtesWith(/*mixed*/)
    {
		$rules = func_get_args();
		$attributes = array();
		foreach($rules as $rule){
			foreach($this->properties as $property => $annotations){
				if(!isset($annotations[$rule]))
					continue;
				
				$attributes[$property] = $annotations[$rule];
			}
		}
		
		return $attributes;
	}

}
