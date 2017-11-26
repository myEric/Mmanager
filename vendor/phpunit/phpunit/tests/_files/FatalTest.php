<?php

class FatalTest extends PHPUnit_Framework_TestCase
{
<<<<<<< HEAD
    public function testFatalError()
    {
        if(extension_loaded('xdebug')) {
            xdebug_disable();
        }

        non_existing_function();
    }

=======
	public function testFatalError()
	{
		if (extension_loaded('xdebug')) {
			xdebug_disable();
		}

		eval('class FatalTest {}');
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
