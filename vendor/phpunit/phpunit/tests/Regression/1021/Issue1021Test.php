<?php
class Issue1021Test extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider provider
	 */
	public function testSomething($data)
	{
		$this->assertTrue($data);
	}

	/**
	 * @depends testSomething
	 */
	public function testSomethingElse()
	{
	}

<<<<<<< HEAD
    public function provider()
    {
        return array(array(true));
    }
=======
	public function provider()
	{
		return [[true]];
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
