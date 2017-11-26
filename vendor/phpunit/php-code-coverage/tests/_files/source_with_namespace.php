<?php
namespace bar\baz;

/**
 * Represents foo.
 */
class source_with_namespace
{
}

/**
 * @param mixed $bar
 */
function &foo($bar)
{
<<<<<<< HEAD
    $baz = function () {};
    $a   = true ? true : false;
    $b = "{$a}";
    $c = "${b}";
=======
	$baz = function () {};
	$a   = true ? true : false;
	$b   = "{$a}";
	$c   = "${b}";
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
