<?php


$proj = substr(__DIR__,0,strrpos(__DIR__, '/'));

set_include_path($proj .'/library'. PATH_SEPARATOR . $proj.'/examples/Model' .PATH_SEPARATOR. $proj.'/examples' .PATH_SEPARATOR. $proj.'/vendor/Respect/library' .PATH_SEPARATOR. get_include_path());
require_once $proj.'/library/SimpleAnnotation/SplClassLoader.php';

$myLoader = new \SplClassLoader();
$myLoader->register();

