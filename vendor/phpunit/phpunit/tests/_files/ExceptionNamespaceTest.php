<?php

namespace My\Space;

class ExceptionNamespaceTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Exception message
	 *
	 * @var string
	 */
	const ERROR_MESSAGE = 'Exception namespace message';

<<<<<<< HEAD
    /**
     * Exception code
     *
     * @var integer
     */
    const ERROR_CODE = 200;
=======
	/**
	 * Exception code
	 *
	 * @var int
	 */
	const ERROR_CODE = 200;
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	/**
	 * @expectedException Class
	 * @expectedExceptionMessage My\Space\ExceptionNamespaceTest::ERROR_MESSAGE
	 * @expectedExceptionCode My\Space\ExceptionNamespaceTest::ERROR_CODE
	 */
	public function testConstants()
	{
	}

	/**
	 * @expectedException Class
	 * @expectedExceptionCode My\Space\ExceptionNamespaceTest::UNKNOWN_CODE_CONSTANT
	 * @expectedExceptionMessage My\Space\ExceptionNamespaceTest::UNKNOWN_MESSAGE_CONSTANT
	 */
	public function testUnknownConstants()
	{
	}
}
