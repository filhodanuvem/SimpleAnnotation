<?php 

require_once 'config.php';

echo <<<'HEAD'
    <head>
        <title>SimpleAnnotation - Help</title>
    </head>
	<h2>SimpleAnnotation</h2>
	A small php project that insert semantic on classes using annotations.<br />
	Today, many programming languages are using annotations for to manager injection depending and
    inversion of control. In the php's core, we haven't this feature, but some projects like <a target="_blank" href="http://symfony.com/">Symfony</a> 
    <a href="http://www.doctrine-project.org/" target="_blank">Doctrine</a> and <a href="http://www.docblox-project.org/" target="_blank">Docblox</a> was implement.
	This project (with a filosophy <a href="http://microphp.org/" target="_blank">MicroPHP manifesto</a> "where small and simple is better") have a goal of
	be a simple layer for insert annotations in other php small projects.<br /><br />     
HEAD;
use Model as m;
use SimpleAnnotation\Annotation as annot;
use SimpleAnnotation\Exceptions as ex;
if(!array_key_exists('page', $_GET)){

	// using a Model examples
	
	echo '<h3>How to use</h3>';
	echo 'Requirements <hr /> 
	<ul>
		<li>PHP 5.3+</li>
		<li>Respect\Validation library</li>
	</ul>';
	
	echo 'Reserved annotations<hr />
	<ul>
		<li>@validation - Use Respect\Validation to test value</li>
	</ul>
	';
	
	echo 'Using<hr />';
    echo 'Look the simple class Person <br /><br />';
    highlight_string('<?php
        namespace Model;

        class Person extends Model
        {
            /**
            * @var int
            */
            protected $id;
            /**
             * @var string
             */
            protected $name;
            
            /**
             * @var cpf
             */
            protected $cpf;
            
            public function getId(){
                return $this->id;
            }
            
            public function setId($value){
                $this->id = $value;
            }
            
            public function getName(){
                return $this->name;
            }
            
            public function setName($value){
                $this->name = $value;
            }
            
            public function setCpf($value){
                $this->cpf = $value;
            }
            
            public function getCpf(){
                return $this->cpf;
            }	
        }');
    echo '<br /><br />First we setting the paths to autoload using SplClassLoader.<br />';
	highlight_string('
	<?php 
		set_include_path(\'/my/library\' . PATH_SEPARATOR . \'/path/to/respect\' . PATH_SEPARATOR . get_include_path());
		require_once \'SplClassLoader.php\';
		$myLoader = new \SplClassLoader();
		$myLoader->register();
	?>');
	echo '<br /><br />SimpleAnnotation is namespaced, but you can make your life easier by importing a single class into your context: <br />';
	highlight_string('
	<?php 
		use SimpleAnnotation\Annotation as annot; ');
	echo '<br /><br />Now you are ready for to use this library. <br /><br />';
	highlight_string('
	<?php 
		// first, we create the objeto that you want to use annotation (we used namespace again)
        use Model as m;
		$foo = new m\Person();
        $foo->setName(\'Claudson\');
		$a = new annot($foo);
        // using default validate method that tests if all fields is valid values.
		$a->validate();
	');
    $foo = new m\Person();
    $foo->setName("claudson");
    $a   = new annot($foo);
    try{
        var_dump($a->validate());
    }catch(ex\AnnotationValidationException $e){
        var_dump($e->getMessage());
    }
	echo '<br /><br />Right now, this method validate() returned a array with a status of the each attribute noted<br />
    <a href="?page=example">Read a pratical example</a>';
}else{
	switch($_GET['page']){
		
		case 'validators':
			echo '<br /><h3>The Validators</h3>';
            echo 'The SimpleAnnotation use <a href="https://github.com/Respect/Validation">Respect\Validation</a>, the most awesome validation engine ever created for PHP.
In this library. ';
			break;
        case 'example':
            // using a Model examples
	
			echo 'The Foo class contain a field $value, we use annotation @var to define that  this attributte is of integer type';
			highlight_string('
			<?php 
			class Foo extends Model 
			{
				/**
				* @var int
				*/
				protected $value;
				
				public function getValue(){
					return $this->value;
				}
				
				public function setValue($value){
					$this->value = $value;
				}
				
			}
			?>');
			$foo = new m\Foo();
			$foo->setValue(3);
			
			echo '<br /><br />Right now, we created a Foo object and setting your field $value like a integer<br />';
			highlight_string('
			<?php 
				use Model as m;
				$foo = new m\Foo();
				$foo->setValue(3); 
			?>');
			
			echo '<br /><br />So, we use save method, like a Active record pattern. Automatically we have a status array that inform us about each field';
			highlight_string('
			<?php 
				$foo->save(); 
			?>');
			$foo->save();
			var_dump($foo);
			
			echo '<br /><br />But, if $value was setted with a string value we would the next result:';
			$foo->setValue('bar');
			$foo->save();
			var_dump($foo);
	echo '<br />The SimpleAnnotation used a Respect Validation for filter the field. <a href="https://github.com/Respect/Validation" target="_blank">read more</a>';
            break;
        default:
			echo 'ERROR!';
	}
}
