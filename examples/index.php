<?php 

require_once 'config.php';

echo <<<'HEAD'
	<h2>SimpleAnnotation</h2>
	A small php project that insert semantic on classes using annotations<br /><br /><br />
HEAD;


// using a Model examples
use Model as m;

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