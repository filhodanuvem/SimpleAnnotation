<?php

namespace SimpleAnnotation;
class ValidateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerValidatesOk
     */
    public function test_validates($input)
    {
        $this->assertTrue($input->validate());
    }
    
    /**
     * @dataProvider providerValidatesFail
     */
    public function test_validates_fail($input)
    {
        $this->assertNotEquals($input->validate(),true);
        
    }
    
    
    public function providerValidatesOk()
    {
        // creating the mocks and settings
        $foo = new \Model\Foo;
        $foo->setValue(2012);
        
        $bar = new \Model\Bar; 
        $bar->setDate('2012-02-22');
        
        $p = new \Model\Person;
        $p->setId(22);
        $p->setCpf('099.660.926-17');
        $p->setName('Claudson Oliveira');
        return array(
            array(new Annotation($foo)),
            array(new Annotation($bar)),
            array(new Annotation($p)),
        );
    }
    
    public function providerValidatesFail()
    {
        // creating the mocks and settings 
        $foo = new \Model\Foo;
        $foo->setValue('It\'s a not number');
        
        $bar = new \Model\Bar; 
        $bar->setDate(22);
        
        $p = new \Model\Person;
        $p->setId('9'); // it's would to pass, because '9' is cast to number 9  
        $p->setCpf(null);
        $p->setName('Claudson Oliveira');
        return array(
            array(new Annotation($foo)),
            array(new Annotation($bar)),
            array(new Annotation($p)),
        );
    }
    
}
