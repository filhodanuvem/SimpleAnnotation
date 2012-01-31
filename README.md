SimpleAnnotation 
==================

A small php project that insert semantic on classes using annotations.<br />
Today, many programming languages are using annotations for to manager dependency Injection and
inversion of control. In the php's core, we haven't this feature, but some projects like <a target="_blank" href="http://symfony.com/">Symfony</a> 
<a href="http://www.doctrine-project.org/" target="_blank">Doctrine</a> and <a href="http://www.docblox-project.org/" target="_blank">Docblox</a> was implement.
This project (with a filosophy <a href="http://microphp.org/" target="_blank">MicroPHP manifesto</a> "where small and simple is better") have a goal of
be a simple layer for insert annotations in other php small projects.

Requirements
-------

1. PHP5.3+
2. Respect\Validation library

Reserved annotations
-------
@validate - Use Respect\Validation to test value

TO DO
-------
- Add new semantic rules, for example: @validate date('Y-m-d H:i:s') for create um Validator better.
- Use a APC or other cache manager 
- Use the Reader from Doctrine 


Installation
============

**CAUTION**, this is not ready for production! Use it just for fun until a 
stable version comes out.

cd /var/www/ <br />
git clone git@github.com:cloudson/SimpleAnnotation.git #cloning repo <br />
cd SimpleAnnotation/  <br />
git submodule init  <br />
git submodule update  #updating Vendors <br />


Autoloading
-----------

You can set up SimpleAnnotation for autoloading. We recommend using the 
SplClassLoader. Here's a nice sample:
    
    set_include_path('/my/library' . PATH_SEPARATOR . '/path/to/respect' . PATH_SEPARATOR . get_include_path());
    require_once 'SplClassLoader.php';
    $myLoader = new \SplClassLoader();
    $myLoader->register();


Feature Guide
=============

Namespace import
----------------

SimpleAnnotation is namespaced, you can use it:

    <?php 
        use SimpleAnnotation\Annotation as annot; <br />

Using
-----------------

    <?php 
        // first, we create the objeto that you want to use annotation (we used namespace again) 
        use Model as m; 
        $foo = new m\Person(); 
        $foo->setName('Claudson'); 
        $a = new annot($foo); 
        // using default validate method that tests if all fields is valid values. 
        $a->validate(); 
    

