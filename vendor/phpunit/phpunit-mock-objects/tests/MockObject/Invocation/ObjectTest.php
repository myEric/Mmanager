<?php

class Framework_MockObject_Invocation_ObjectTest extends PHPUnit_Framework_TestCase
{
<<<<<<< HEAD
    public function testConstructorRequiresClassAndMethodAndParametersAndObject()
    {
        new PHPUnit_Framework_MockObject_Invocation_Object(
            'FooClass',
            'FooMethod',
            array('an_argument'),
            new StdClass);
    }

    public function testAllowToGetClassNameSetInConstructor()
    {
        $invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
            'FooClass',
            'FooMethod',
            array('an_argument'),
            new StdClass);

        $this->assertSame('FooClass', $invocation->className);
    }

    public function testAllowToGetMethodNameSetInConstructor()
    {
        $invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
            'FooClass',
            'FooMethod',
            array('an_argument'),
            new StdClass);

        $this->assertSame('FooMethod', $invocation->methodName);
    }

    public function testAllowToGetObjectSetInConstructor()
    {
        $expectedObject = new StdClass;

        $invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
            'FooClass',
            'FooMethod',
            array('an_argument'),
            $expectedObject);

        $this->assertSame($expectedObject, $invocation->object);
    }

    public function testAllowToGetMethodParametersSetInConstructor()
    {
        $expectedParameters = array(
          'foo', 5, array('a', 'b'), new StdClass, NULL, FALSE
        );

        $invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
          'FooClass',
          'FooMethod',
          $expectedParameters,
          new StdClass
        );

        $this->assertSame($expectedParameters, $invocation->parameters);
    }

    public function testConstructorAllowToSetFlagCloneObjectsInParameters()
    {
        $parameters   = array(new StdClass);
        $cloneObjects = TRUE;

        $invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
          'FooClass',
          'FooMethod',
          $parameters,
          new StdClass,
          $cloneObjects
        );

        $this->assertEquals($parameters, $invocation->parameters);
        $this->assertNotSame($parameters, $invocation->parameters);
    }
=======
	public function testConstructorRequiresClassAndMethodAndParametersAndObject()
	{
		new PHPUnit_Framework_MockObject_Invocation_Object(
			'FooClass',
			'FooMethod',
			['an_argument'],
			'ReturnType',
			new StdClass
		);
	}

	public function testAllowToGetClassNameSetInConstructor()
	{
		$invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
			'FooClass',
			'FooMethod',
			['an_argument'],
			'ReturnType',
			new StdClass
		);

		$this->assertSame('FooClass', $invocation->className);
	}

	public function testAllowToGetMethodNameSetInConstructor()
	{
		$invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
			'FooClass',
			'FooMethod',
			['an_argument'],
			'ReturnType',
			new StdClass
		);

		$this->assertSame('FooMethod', $invocation->methodName);
	}

	public function testAllowToGetObjectSetInConstructor()
	{
		$expectedObject = new StdClass;

		$invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
			'FooClass',
			'FooMethod',
			['an_argument'],
			'ReturnType',
			$expectedObject
		);

		$this->assertSame($expectedObject, $invocation->object);
	}

	public function testAllowToGetMethodParametersSetInConstructor()
	{
		$expectedParameters = [
		  'foo', 5, ['a', 'b'], new StdClass, null, false
		];

		$invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
			'FooClass',
			'FooMethod',
			$expectedParameters,
			'ReturnType',
			new StdClass
		);

		$this->assertSame($expectedParameters, $invocation->parameters);
	}

	public function testConstructorAllowToSetFlagCloneObjectsInParameters()
	{
		$parameters   = [new StdClass];
		$cloneObjects = true;

		$invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
			'FooClass',
			'FooMethod',
			$parameters,
			'ReturnType',
			new StdClass,
			$cloneObjects
		);

		$this->assertEquals($parameters, $invocation->parameters);
		$this->assertNotSame($parameters, $invocation->parameters);
	}

	public function testAllowToGetReturnTypeSetInConstructor()
	{
		$expectedReturnType = 'string';

		$invocation = new PHPUnit_Framework_MockObject_Invocation_Object(
			'FooClass',
			'FooMethod',
			['an_argument'],
			$expectedReturnType,
			new StdClass
		);

		$this->assertSame($expectedReturnType, $invocation->returnType);
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
