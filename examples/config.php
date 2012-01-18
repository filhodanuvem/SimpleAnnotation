<?php

/**
 * 
 * setting autoload 
 * @param string $class_name
 */

$proj = substr(__DIR__,0,strrpos(__DIR__, '/'));
$root = substr($proj,0,strrpos($proj, '/'));

set_include_path($root . PATH_SEPARATOR . $proj.'/vendor' .PATH_SEPARATOR. $proj.'/vendor/Respect/library' .PATH_SEPARATOR. get_include_path());
require_once 'SplClassLoader.php';

$myLoader = new \SplClassLoader();
$myLoader->register();