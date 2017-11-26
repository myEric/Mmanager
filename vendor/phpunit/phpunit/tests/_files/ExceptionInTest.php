<?php
class ExceptionInTest extends PHPUnit_Framework_TestCase
{
<<<<<<< HEAD
    public $setUp = false;
    public $assertPreConditions = false;
    public $assertPostConditions = false;
    public $tearDown = false;
    public $testSomething = false;
=======
	public $setUp                = false;
	public $assertPreConditions  = false;
	public $assertPostConditions = false;
	public $tearDown             = false;
	public $testSomething        = false;
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	protected function setUp()
	{
		$this->setUp = true;
	}

	protected function assertPreConditions()
	{
		$this->assertPreConditions = true;
	}

	public function testSomething()
	{
		$this->testSomething = true;
		throw new Exception;
	}

	protected function assertPostConditions()
	{
		$this->assertPostConditions = true;
	}

	protected function tearDown()
	{
		$this->tearDown = true;
	}
}
