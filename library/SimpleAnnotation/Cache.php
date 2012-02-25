<?php
/**
* Class that work like a layer that block the library of the 
* to process the comment blocks every request 
* @author Claudson Oliveira
*
*/
namespace SimpleAnnotation;
class Cache
{
    private static $ident_block = 'block.cache';
    private static $ident_prop  = 'prop.cache';  
    private static $time_expire =  86400;
    private static $port        =  540007;
    
	/**
	 * 
	 * Method that return the cache data from a Annotation  
	 * @param  Annotation $annot
	 * @return Array 
	 */
	public function getCacheBlock(Annotation $annot)
	{
        return \apc_fetch(md5($annot->getNameTarget()).self::$ident_block);
		/*$folder = __DIR__.'/.cache/';
		if(!is_dir($folder)){
			return null;
		}
		
		$file = $folder.$annot->getNameTarget().'.block.cache';
		if(!is_file($file)){
			return null;	
		}
		
		return file_get_contents($file);*/
	}
	
	public function getCache(Annotation $annot)
	{
        return apc_fetch(md5($annot->getNameTarget()).self::$ident_prop);
		/*$folder = __DIR__.'/.cache/';
		if(!is_dir($folder)){
			return null;
		}
	
		$file = $folder.$annot->getNameTarget().'.prop.cache';
		if(!is_file($file)){
			return null;
		}
	
		return file_get_contents($file);*/
	}
	
	public function setCache(Annotation $annot){
		apc_add(md5($annot->getNameTarget()).self::$ident_block,$annot->getHashBlock(),self::$time_expire);
        apc_add(md5($annot->getNameTarget()).self::$ident_prop,$annot->getHash(),self::$time_expire);
        /*$folder = __DIR__.'/cache/';
		if(!is_dir($folder)){
			mkdir($folder);
			chmod($folder,0744);
		}
		
		$fileBlock = $folder.$annot->getNameTarget().'.block.cache';
		$fileProp  = $folder.$annot->getNameTarget().'.prop.cache';
		if(is_file($fileBlock)){
			unlink($fileBlock);
			unlink($fileProp);	
		}
		$p = fopen($fileBlock, 'w+');
		fwrite($p, str_ireplace(' ', '',$annot->getHashBlock() ));
		
		$p = fopen($fileProp, 'w+');
		fwrite($p, $annot->getHash());*/
	}

}
