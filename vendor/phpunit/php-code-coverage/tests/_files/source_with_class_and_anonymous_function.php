<?php

class CoveredClassWithAnonymousFunctionInStaticMethod
{
<<<<<<< HEAD
    public static function runAnonymous()
    {
        $filter = array('abc124', 'abc123', '123');
=======
	public static function runAnonymous()
	{
		$filter = ['abc124', 'abc123', '123'];
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

		array_walk(
			$filter,
			function (&$val, $key) {
				$val = preg_replace('|[^0-9]|', '', $val);
			}
		);

		// Should be covered
		$extravar = true;
	}
}
