<?php
class DependencyFailureTest extends PHPUnit_Framework_TestCase
{
	public function testOne()
	{
		$this->fail();
	}

	/**
	 * @depends testOne
	 */
	public function testTwo()
	{
	}

<<<<<<< HEAD
    /**
     * @depends testTwo
     */
    public function testThree()
    {
    }
=======
	/**
	 * @depends !clone testTwo
	 */
	public function testThree()
	{
	}

	/**
	 * @depends clone testOne
	 */
	public function testFour()
	{
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
