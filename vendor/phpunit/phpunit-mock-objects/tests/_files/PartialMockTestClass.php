<?php
class PartialMockTestClass
{
<<<<<<< HEAD:vendor/phpunit/phpunit-mock-objects/tests/_files/PartialMockTestClass.php
    public $constructorCalled = FALSE;

    public function __construct()
    {
        $this->constructorCalled = TRUE;
    }
=======
	public $constructorCalled = false;

	public function __construct()
	{
		$this->constructorCalled = true;
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e:vendor/phpunit/phpunit-mock-objects/tests/_fixture/PartialMockTestClass.php

	public function doSomething()
	{
	}

	public function doAnotherThing()
	{
	}
}
