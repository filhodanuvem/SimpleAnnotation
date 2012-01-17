<?php
/**
* Class that group all annotations of the one object
* 
* @author Claudson Oliveira
*
*/
namespace SimpleAnnotation ;
use Respect\Validation\Validator as v;

class Annotation
{
    protected $reflection; 
    protected $properties;
    protected $parser;
    protected $target ; 
    protected $status;
    protected $blocks;
    /**
    *
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
    private function getAllDocs(){
    	$props = $this->reflection->getProperties();
    	$blocks = array();
    	foreach($props as $p){
    		$propReflect = new \ReflectionProperty($p->class,$p->name);
    		$blocks[$p->name] = $propReflect->getDocComment();
    	}
    	return $blocks;
    }
    
    public function execute(){
    	$this->properties = array();
    	foreach($this->blocks as $name => $block){
    		$this->properties[$name] = $this->parser->read($block);
    	}
    	return $this->properties;
    }
    
    public function filter()
    {
        $this->status = array();
        foreach($this->properties as $attr => $p){
            if($p){
                $validator = $p['var'];
                $access    = 'get'.ucfirst($attr);
                $this->status[$attr] = v::$validator()->validate($this->target->$access());
            }
        }
    }
    
    public function getHash()
    {
    	return str_replace(' ', '',serialize($this->properties));
    }
    
    public function getHashBlock()
    {
    	return str_replace(' ', '',serialize($this->blocks));
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function getNameTarget(){
    	return $this->reflection->getName();
    }

}
