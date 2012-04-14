<?php

/**
 * 
 * setting autoload 
 * @param string $class_name
 */
/*
$proj = substr(__DIR__,0,strrpos(__DIR__, '/'));
$root = substr($proj,0,strrpos($proj, '/'));

set_include_path($proj .'/library'. PATH_SEPARATOR . $proj.'/vendor' .PATH_SEPARATOR. $proj.'/vendor/Respect/Validation/library' .PATH_SEPARATOR. get_include_path());
require_once '../library/SimpleAnnotation/SplClassLoader.php';

$myLoader = new \SplClassLoader();
$myLoader->register();*/

if(!file_exists(__DIR__.'/../vendor/.composer/autoload.php')){
   echo 'You need install composer.';
   exit;
}

require_once __DIR__.'/../vendor/.composer/autoload.php';

