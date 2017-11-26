<?php
class Singleton
{
	private static $uniqueInstance = null;

	protected function __construct()
	{
	}

<<<<<<< HEAD
    private final function __clone()
    {
    }

    public static function getInstance()
    {
        if (self::$uniqueInstance === null) {
            self::$uniqueInstance = new Singleton;
        }
=======
	final private function __clone()
	{
	}

	public static function getInstance()
	{
		if (self::$uniqueInstance === null) {
			self::$uniqueInstance = new self;
		}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

		return self::$uniqueInstance;
	}
}
