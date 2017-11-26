<?php
class DataProviderFilterTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider truthProvider
	 */
	public function testTrue($truth)
	{
		$this->assertTrue($truth);
	}

<<<<<<< HEAD
    public static function truthProvider()
    {
        return array(
           array(true),
           array(true),
           array(true),
           array(true)
        );
    }
=======
	public static function truthProvider()
	{
		return [
		   [true],
		   [true],
		   [true],
		   [true]
		];
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	/**
	 * @dataProvider falseProvider
	 */
	public function testFalse($false)
	{
		$this->assertFalse($false);
	}

<<<<<<< HEAD
    public static function falseProvider()
    {
        return array(
          'false test'=>array(false),
          'false test 2'=>array(false),
          'other false test'=>array(false),
          'other false test2'=>array(false)
        );
    }
}
=======
	public static function falseProvider()
	{
		return [
		  'false test'       => [false],
		  'false test 2'     => [false],
		  'other false test' => [false],
		  'other false test2'=> [false]
		];
	}
}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
