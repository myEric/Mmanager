<?php
class DataProviderTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider providerMethod
	 */
	public function testAdd($a, $b, $c)
	{
		$this->assertEquals($c, $a + $b);
	}

<<<<<<< HEAD
    public static function providerMethod()
    {
        return array(
          array(0, 0, 0),
          array(0, 1, 1),
          array(1, 1, 3),
          array(1, 0, 1)
        );
    }
=======
	public static function providerMethod()
	{
		return [
		  [0, 0, 0],
		  [0, 1, 1],
		  [1, 1, 3],
		  [1, 0, 1]
		];
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
