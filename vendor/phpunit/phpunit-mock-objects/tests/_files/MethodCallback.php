<?php
class MethodCallback
{
	public static function staticCallback()
	{
		$args = func_get_args();

<<<<<<< HEAD:vendor/phpunit/phpunit-mock-objects/tests/_files/MethodCallback.php
        if ($args == array('foo', 'bar')) {
            return 'pass';
        }
    }
=======
		if ($args == ['foo', 'bar']) {
			return 'pass';
		}
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e:vendor/phpunit/phpunit-mock-objects/tests/_fixture/MethodCallback.php

	public function nonStaticCallback()
	{
		$args = func_get_args();

<<<<<<< HEAD:vendor/phpunit/phpunit-mock-objects/tests/_files/MethodCallback.php
        if ($args == array('foo', 'bar')) {
            return 'pass';
        }
    }
=======
		if ($args == ['foo', 'bar']) {
			return 'pass';
		}
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e:vendor/phpunit/phpunit-mock-objects/tests/_fixture/MethodCallback.php
}
