<?php

class BaseTestListenerSample extends PHPUnit_Framework_BaseTestListener
{
	public $endCount = 0;

<<<<<<< HEAD
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        $this->endCount++;
    }
}
=======
	public function endTest(PHPUnit_Framework_Test $test, $time)
	{
		$this->endCount++;
	}
}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
