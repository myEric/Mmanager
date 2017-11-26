<?php

class Framework_MockObject_Invocation_StaticTest extends PHPUnit_Framework_TestCase
{
<<<<<<< HEAD
    public function testConstructorRequiresClassAndMethodAndParameters()
    {
        new PHPUnit_Framework_MockObject_Invocation_Static('FooClass', 'FooMethod', array('an_argument'));
    }

    public function testAllowToGetClassNameSetInConstructor()
    {
        $invocation = new PHPUnit_Framework_MockObject_Invocation_Static('FooClass', 'FooMethod', array('an_argument'));
=======
	public function testConstructorRequiresClassAndMethodAndParameters()
	{
		new PHPUnit_Framework_MockObject_Invocation_Static(
			'FooClass',
			'FooMethod',
			['an_argument'],
			'ReturnType'
		);
	}

	public function testAllowToGetClassNameSetInConstructor()
	{
		$invocation = new PHPUnit_Framework_MockObject_Invocation_Static(
			'FooClass',
			'FooMethod',
			['an_argument'],
			'ReturnType'
		);
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

		$this->assertSame('FooClass', $invocation->className);
	}

<<<<<<< HEAD
    public function testAllowToGetMethodNameSetInConstructor()
    {
        $invocation = new PHPUnit_Framework_MockObject_Invocation_Static('FooClass', 'FooMethod', array('an_argument'));
=======
	public function testAllowToGetMethodNameSetInConstructor()
	{
		$invocation = new PHPUnit_Framework_MockObject_Invocation_Static(
			'FooClass',
			'FooMethod',
			['an_argument'],
			'ReturnType'
		);
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

		$this->assertSame('FooMethod', $invocation->methodName);
	}

<<<<<<< HEAD
    public function testAllowToGetMethodParametersSetInConstructor()
    {
        $expectedParameters = array(
          'foo', 5, array('a', 'b'), new StdClass, NULL, FALSE
        );

        $invocation = new PHPUnit_Framework_MockObject_Invocation_Static(
          'FooClass', 'FooMethod', $expectedParameters
        );
=======
	public function testAllowToGetMethodParametersSetInConstructor()
	{
		$expectedParameters = [
		  'foo', 5, ['a', 'b'], new StdClass, null, false
		];

		$invocation = new PHPUnit_Framework_MockObject_Invocation_Static(
			'FooClass',
			'FooMethod',
			$expectedParameters,
			'ReturnType'
		);
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

		$this->assertSame($expectedParameters, $invocation->parameters);
	}

<<<<<<< HEAD
    public function testConstructorAllowToSetFlagCloneObjectsInParameters()
    {
        $parameters = array(new StdClass);
        $cloneObjects = TRUE;

        $invocation = new PHPUnit_Framework_MockObject_Invocation_Static(
          'FooClass',
          'FooMethod',
          $parameters,
          $cloneObjects
        );

        $this->assertEquals($parameters, $invocation->parameters);
        $this->assertNotSame($parameters, $invocation->parameters);
    }
=======
	public function testConstructorAllowToSetFlagCloneObjectsInParameters()
	{
		$parameters   = [new StdClass];
		$cloneObjects = true;

		$invocation = new PHPUnit_Framework_MockObject_Invocation_Static(
			'FooClass',
			'FooMethod',
			$parameters,
			'ReturnType',
			$cloneObjects
		);

		$this->assertEquals($parameters, $invocation->parameters);
		$this->assertNotSame($parameters, $invocation->parameters);
	}

	public function testAllowToGetReturnTypeSetInConstructor()
	{
		$expectedReturnType = 'string';

		$invocation = new PHPUnit_Framework_MockObject_Invocation_Static(
			'FooClass',
			'FooMethod',
			['an_argument'],
			$expectedReturnType
		);

		$this->assertSame($expectedReturnType, $invocation->returnType);
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
