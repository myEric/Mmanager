<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2001-2014, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Jeroen Versteeg <jversteeg@gmail.com>
 * @copyright  2001-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.7.30
 */

/**
 *
 *
 * @package    PHPUnit
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Jeroen Versteeg <jversteeg@gmail.com>
 * @copyright  2001-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.7.30
 * @covers     PHPUnit_Framework_Constraint_Count
 */
class CountTest extends PHPUnit_Framework_TestCase
{
<<<<<<< HEAD
    public function testCount()
    {
        $countConstraint = new PHPUnit_Framework_Constraint_Count(3);
        $this->assertTrue($countConstraint->evaluate(array(1,2,3), '', true));

        $countConstraint = new PHPUnit_Framework_Constraint_Count(0);
        $this->assertTrue($countConstraint->evaluate(array(), '', true));

        $countConstraint = new PHPUnit_Framework_Constraint_Count(2);
        $it = new TestIterator(array(1, 2));
        $this->assertTrue($countConstraint->evaluate($it, '', true));
    }
=======
	public function testCount()
	{
		$countConstraint = new PHPUnit_Framework_Constraint_Count(3);
		$this->assertTrue($countConstraint->evaluate([1, 2, 3], '', true));

		$countConstraint = new PHPUnit_Framework_Constraint_Count(0);
		$this->assertTrue($countConstraint->evaluate([], '', true));

		$countConstraint = new PHPUnit_Framework_Constraint_Count(2);
		$it              = new TestIterator([1, 2]);
		$this->assertTrue($countConstraint->evaluate($it, '', true));
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	public function testCountDoesNotChangeIteratorKey()
	{
		$countConstraint = new PHPUnit_Framework_Constraint_Count(2);

<<<<<<< HEAD
        // test with 1st implementation of Iterator
        $it = new TestIterator(array(1, 2));
=======
		// test with 1st implementation of Iterator
		$it = new TestIterator([1, 2]);
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

		$countConstraint->evaluate($it, '', true);
		$this->assertEquals(1, $it->current());

		$it->next();
		$countConstraint->evaluate($it, '', true);
		$this->assertEquals(2, $it->current());

		$it->next();
		$countConstraint->evaluate($it, '', true);
		$this->assertFalse($it->valid());

<<<<<<< HEAD
        // test with 2nd implementation of Iterator
        $it = new TestIterator2(array(1, 2));
=======
		// test with 2nd implementation of Iterator
		$it = new TestIterator2([1, 2]);
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

		$countConstraint = new PHPUnit_Framework_Constraint_Count(2);
		$countConstraint->evaluate($it, '', true);
		$this->assertEquals(1, $it->current());

		$it->next();
		$countConstraint->evaluate($it, '', true);
		$this->assertEquals(2, $it->current());

		$it->next();
		$countConstraint->evaluate($it, '', true);
		$this->assertFalse($it->valid());
	}
}
