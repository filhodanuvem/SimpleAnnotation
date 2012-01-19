<?php 

require_once 'config.php';

echo <<<'HEAD'
	<h2>SimpleAnnotation</h2>
	A small php project that insert semantic on classes using annotations.<br />
	Today, many programming languages are using annotations for to manager injection depending and
    inversion of control. In the php's core, we haven't this feature, but some projects like <a href="#">Symphony</a> 
    <a href="#">Doctrine</a> and <a href="#">DocBlox</a> was implement.
	This project (with a filosophy <a href="#">MicroPHP manifesto</a> "where small and simple is better") have a goal of
	be a simple layer for insert annotations in other php small projects.<br /><br />     
HEAD;
use Model as m;
if(!array_key_exists('page', $_GET)){

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
	echo '<br />The SimpleAnnotation used a Respect Validation for filter the field. <a href="?page=core">read more</a>';
}else{
	switch($_GET['page']){
		
		case 'validators':
			echo '<br /><h3>The Validators</h3>';
            echo 'The SimpleAnnotation use <a href="https://github.com/Respect/Validation">Respect\Validation</a>, the most awesome validation engine ever created for PHP.
In this library. ';
			break;
        case 'core':
            echo '<br /><h3>The Core</h3>';
            break;
		default:
			echo 'ERROR!';
	}
}
