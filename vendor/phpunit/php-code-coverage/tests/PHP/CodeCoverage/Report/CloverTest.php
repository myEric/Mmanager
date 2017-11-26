<?php
/*
 * This file is part of the PHP_CodeCoverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

<<<<<<< HEAD
if (!defined('TEST_FILES_PATH')) {
    define(
      'TEST_FILES_PATH',
      dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR .
      '_files' . DIRECTORY_SEPARATOR
    );
}

require_once TEST_FILES_PATH . '../TestCase.php';
=======
require_once dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'TestCase.php';
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

/**
 * Tests for the PHP_CodeCoverage_Report_Clover class.
 *
 * @category   PHP
 * @package    CodeCoverage
 * @subpackage Tests
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://github.com/sebastianbergmann/php-code-coverage
 * @since      Class available since Release 1.0.0
 */
class PHP_CodeCoverage_Report_CloverTest extends PHP_CodeCoverage_TestCase
{
	/**
	 * @covers PHP_CodeCoverage_Report_Clover
	 */
	public function testCloverForBankAccountTest()
	{
		$clover = new PHP_CodeCoverage_Report_Clover;

<<<<<<< HEAD
        $this->assertStringMatchesFormatFile(
          TEST_FILES_PATH . 'BankAccount-clover.xml',
          $clover->process($this->getCoverageForBankAccount(), null, 'BankAccount')
        );
    }
=======
		$this->assertStringMatchesFormatFile(
			TEST_FILES_PATH . 'BankAccount-clover.xml',
			$clover->process($this->getCoverageForBankAccount(), null, 'BankAccount')
		);
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	/**
	 * @covers PHP_CodeCoverage_Report_Clover
	 */
	public function testCloverForFileWithIgnoredLines()
	{
		$clover = new PHP_CodeCoverage_Report_Clover;

<<<<<<< HEAD
        $this->assertStringMatchesFormatFile(
          TEST_FILES_PATH . 'ignored-lines-clover.xml',
          $clover->process($this->getCoverageForFileWithIgnoredLines())
        );
    }
=======
		$this->assertStringMatchesFormatFile(
			TEST_FILES_PATH . 'ignored-lines-clover.xml',
			$clover->process($this->getCoverageForFileWithIgnoredLines())
		);
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	/**
	 * @covers PHP_CodeCoverage_Report_Clover
	 */
	public function testCloverForClassWithAnonymousFunction()
	{
		$clover = new PHP_CodeCoverage_Report_Clover;

<<<<<<< HEAD
        $this->assertStringMatchesFormatFile(
          TEST_FILES_PATH . 'class-with-anonymous-function-clover.xml',
          $clover->process($this->getCoverageForClassWithAnonymousFunction())
        );
    }
=======
		$this->assertStringMatchesFormatFile(
			TEST_FILES_PATH . 'class-with-anonymous-function-clover.xml',
			$clover->process($this->getCoverageForClassWithAnonymousFunction())
		);
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
