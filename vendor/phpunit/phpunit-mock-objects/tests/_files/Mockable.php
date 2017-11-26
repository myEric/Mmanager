<?php
class Mockable
{
	public $constructorArgs;
	public $cloned;

<<<<<<< HEAD:vendor/phpunit/phpunit-mock-objects/tests/_files/Mockable.php
    public function __construct($arg1 = NULL, $arg2 = NULL)
    {
        $this->constructorArgs = array($arg1, $arg2);
    }

    public function mockableMethod()
    {
        // something different from NULL
        return TRUE;
    }

    public function anotherMockableMethod()
    {
        // something different from NULL
        return TRUE;
    }

    public function __clone()
    {
        $this->cloned = TRUE;
    }
=======
	public function __construct($arg1 = null, $arg2 = null)
	{
		$this->constructorArgs = [$arg1, $arg2];
	}

	public function mockableMethod()
	{
		// something different from NULL
		return true;
	}

	public function anotherMockableMethod()
	{
		// something different from NULL
		return true;
	}

	public function __clone()
	{
		$this->cloned = true;
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e:vendor/phpunit/phpunit-mock-objects/tests/_fixture/Mockable.php
}
