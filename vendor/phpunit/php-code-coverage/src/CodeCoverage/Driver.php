<?php
/*
 * This file is part of the PHP_CodeCoverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Interface for code coverage drivers.
 *
 * @category   PHP
 * @package    CodeCoverage
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://github.com/sebastianbergmann/php-code-coverage
 * @since      Class available since Release 1.0.0
 */
interface PHP_CodeCoverage_Driver
{
<<<<<<< HEAD
    /**
     * Start collection of code coverage information.
     */
    public function start();
=======
	/**
	 * @var int
	 *
	 * @see http://xdebug.org/docs/code_coverage
	 */
	const LINE_EXECUTED = 1;

	/**
	 * @var int
	 *
	 * @see http://xdebug.org/docs/code_coverage
	 */
	const LINE_NOT_EXECUTED = -1;

	/**
	 * @var int
	 *
	 * @see http://xdebug.org/docs/code_coverage
	 */
	const LINE_NOT_EXECUTABLE = -2;

	/**
	 * Start collection of code coverage information.
	 */
	public function start();
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	/**
	 * Stop collection of code coverage information.
	 *
	 * @return array
	 */
	public function stop();
}
