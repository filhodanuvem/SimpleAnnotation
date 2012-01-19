<?php
/**
* Class that work like a layer that block the library of the 
* to process the comment blocks every request 
* @TODO new names from methods
* @author Claudson Oliveira
*
*/
namespace SimpleAnnotation;

class Cache
{
	
	/**
	 * 
	 * Method that return the cache data from a Annotation  
	 * @param  Annotation $annot
	 * @return Array 
	 */
	public function getCacheBlock(Annotation $annot)
	{
		$folder = __DIR__.'/cache/';
		if(!is_dir($folder)){
			return null;
		}
		
		$file = $folder.$annot->getNameTarget().'.block.cache';
		if(!is_file($file)){
			return null;	
		}
		
		return file_get_contents($file);
	}
	
	public function getCache(Annotation $annot)
	{
		$folder = __DIR__.'/cache/';
		if(!is_dir($folder)){
			return null;
		}
	
		$file = $folder.$annot->getNameTarget().'.prop.cache';
		if(!is_file($file)){
			return null;
		}
	
		return file_get_contents($file);
	}
	
	public function setCache(Annotation $annot){
		$folder = __DIR__.'/cache/';
		if(!is_dir($folder)){
			mkdir($folder);
			
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
		fwrite($p, $annot->getHash());
	}

}