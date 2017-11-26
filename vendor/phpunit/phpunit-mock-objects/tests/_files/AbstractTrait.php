<?php
trait AbstractTrait
{
	abstract public function doSomething();

<<<<<<< HEAD:vendor/phpunit/phpunit-mock-objects/tests/_files/AbstractTrait.php
    public function mockableMethod()
    {
        return TRUE;
    }

    public function anotherMockableMethod()
    {
        return TRUE;
    }
=======
	public function mockableMethod()
	{
		return true;
	}

	public function anotherMockableMethod()
	{
		return true;
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e:vendor/phpunit/phpunit-mock-objects/tests/_fixture/AbstractTrait.php
}
