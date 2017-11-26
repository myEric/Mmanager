<?php
class BeforeAndAfterTest extends PHPUnit_Framework_TestCase
{
	public static $beforeWasRun;
	public static $afterWasRun;

<<<<<<< HEAD
    public static function resetProperties()
    {
        self::$beforeWasRun = 0;
        self::$afterWasRun = 0;
    }
=======
	public static function resetProperties()
	{
		self::$beforeWasRun = 0;
		self::$afterWasRun  = 0;
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	/**
	 * @before
	 */
	public function initialSetup()
	{
		self::$beforeWasRun++;
	}

	/**
	 * @after
	 */
	public function finalTeardown()
	{
		self::$afterWasRun++;
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
