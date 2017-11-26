<?php
class BeforeClassAndAfterClassTest extends PHPUnit_Framework_TestCase
{
<<<<<<< HEAD
    public static $beforeClassWasRun = 0;
    public static $afterClassWasRun = 0;

    public static function resetProperties()
    {
        self::$beforeClassWasRun = 0;
        self::$afterClassWasRun = 0;
    }
=======
	public static $beforeClassWasRun = 0;
	public static $afterClassWasRun  = 0;

	public static function resetProperties()
	{
		self::$beforeClassWasRun = 0;
		self::$afterClassWasRun  = 0;
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	/**
	 * @beforeClass
	 */
	public static function initialClassSetup()
	{
		self::$beforeClassWasRun++;
	}

	/**
	 * @afterClass
	 */
	public static function finalClassTeardown()
	{
		self::$afterClassWasRun++;
	}

<<<<<<< HEAD
    public function test1() {}
    public function test2() {}
=======
	public function test1()
	{
	}
	public function test2()
	{
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
