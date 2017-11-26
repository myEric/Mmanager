<?php
/**
 * Exporter
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
 * @package    Exporter
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Bernhard Schussek <bschussek@2bepublished.at>
 * @copyright  2001-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       https://github.com/sebastianbergmann/exporter
 */

namespace SebastianBergmann\Exporter;

/**
 * @package    Exporter
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @author     Bernhard Schussek <bschussek@2bepublished.at>
 * @copyright  2001-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       https://github.com/sebastianbergmann/exporter
 */
class ExporterTest extends \PHPUnit_Framework_TestCase
{
<<<<<<< HEAD
    private $exporter;
=======
	/**
	 * @var Exporter
	 */
	private $exporter;
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	protected function setUp()
	{
		$this->exporter = new Exporter;
	}

	public function exportProvider()
	{
		$obj2 = new \stdClass;
		$obj2->foo = 'bar';

		$obj3 = (object)array(1,2,"Test\r\n",4,5,6,7,8);

<<<<<<< HEAD
        $obj = new \stdClass;
        //@codingStandardsIgnoreStart
        $obj->null = NULL;
        //@codingStandardsIgnoreEnd
        $obj->boolean = TRUE;
        $obj->integer = 1;
        $obj->double = 1.2;
        $obj->string = '1';
        $obj->text = "this\nis\na\nvery\nvery\nvery\nvery\nvery\nvery\rlong\n\rtext";
        $obj->object = $obj2;
        $obj->objectagain = $obj2;
        $obj->array = array('foo' => 'bar');
        $obj->self = $obj;
=======
		$obj = new \stdClass;
		//@codingStandardsIgnoreStart
		$obj->null = null;
		//@codingStandardsIgnoreEnd
		$obj->boolean = true;
		$obj->integer = 1;
		$obj->double = 1.2;
		$obj->string = '1';
		$obj->text = "this\nis\na\nvery\nvery\nvery\nvery\nvery\nvery\rlong\n\rtext";
		$obj->object = $obj2;
		$obj->objectagain = $obj2;
		$obj->array = array('foo' => 'bar');
		$obj->self = $obj;
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

		$storage = new \SplObjectStorage;
		$storage->attach($obj2);
		$storage->foo = $obj2;

<<<<<<< HEAD
        return array(
            array(NULL, 'null'),
            array(TRUE, 'true'),
            array(1, '1'),
            array(1.0, '1.0'),
            array(1.2, '1.2'),
            array(fopen('php://memory', 'r'), 'resource(%d) of type (stream)'),
            array('1', "'1'"),
            array(array(array(1,2,3), array(3,4,5)),
<<<EOF
=======
		return array(
			array(null, 'null'),
			array(true, 'true'),
			array(false, 'false'),
			array(1, '1'),
			array(1.0, '1.0'),
			array(1.2, '1.2'),
			array(fopen('php://memory', 'r'), 'resource(%d) of type (stream)'),
			array('1', "'1'"),
			array(array(array(1,2,3), array(3,4,5)),
		<<<EOF
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
Array &0 (
    0 => Array &1 (
        0 => 1
        1 => 2
        2 => 3
    )
    1 => Array &2 (
        0 => 3
        1 => 4
        2 => 5
    )
)
EOF
<<<<<<< HEAD
            ),
            // \n\r and \r is converted to \n
            array("this\nis\na\nvery\nvery\nvery\nvery\nvery\nvery\rlong\n\rtext",
<<<EOF
=======
			),
			// \n\r and \r is converted to \n
			array("this\nis\na\nvery\nvery\nvery\nvery\nvery\nvery\rlong\n\rtext",
			<<<EOF
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
'this
is
a
very
very
very
very
very
very
long
text'
EOF
<<<<<<< HEAD
            ),
            array(new \stdClass, 'stdClass Object &%x ()'),
            array($obj,
<<<EOF
=======
			),
			array(new \stdClass, 'stdClass Object &%x ()'),
			array($obj,
			<<<EOF
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
stdClass Object &%x (
    'null' => null
    'boolean' => true
    'integer' => 1
    'double' => 1.2
    'string' => '1'
    'text' => 'this
is
a
very
very
very
very
very
very
long
text'
    'object' => stdClass Object &%x (
        'foo' => 'bar'
    )
    'objectagain' => stdClass Object &%x
    'array' => Array &%d (
        'foo' => 'bar'
    )
    'self' => stdClass Object &%x
)
EOF
<<<<<<< HEAD
            ),
            array(array(), 'Array &%d ()'),
            array($storage,
<<<EOF
=======
			),
			array(array(), 'Array &%d ()'),
			array($storage,
			<<<EOF
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
SplObjectStorage Object &%x (
    'foo' => stdClass Object &%x (
        'foo' => 'bar'
    )
    '%x' => Array &0 (
        'obj' => stdClass Object &%x
        'inf' => null
    )
)
EOF
<<<<<<< HEAD
            ),
            array($obj3,
<<<EOF
=======
			),
			array($obj3,
			<<<EOF
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
stdClass Object &%x (
    0 => 1
    1 => 2
    2 => 'Test\n'
    3 => 4
    4 => 5
    5 => 6
    6 => 7
    7 => 8
)
EOF
			),
			array(
				chr(0) . chr(1) . chr(2) . chr(3) . chr(4) . chr(5),
				'Binary String: 0x000102030405'
			),
			array(
				implode('', array_map('chr', range(0x0e, 0x1f))),
				'Binary String: 0x0e0f101112131415161718191a1b1c1d1e1f'
			),
			array(
				chr(0x00) . chr(0x09),
				'Binary String: 0x0009'
			),
			array(
				'',
				"''"
			),
		);
	}

<<<<<<< HEAD
    /**
     * @dataProvider exportProvider
     */
    public function testExport($value, $expected)
    {
        $this->assertStringMatchesFormat(
          $expected, $this->trimnl($this->exporter->export($value))
        );
    }
=======
	/**
	 * @dataProvider exportProvider
	 */
	public function testExport($value, $expected)
	{
		$this->assertStringMatchesFormat(
			$expected,
			$this->trimNewline($this->exporter->export($value))
		);
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	public function testExport2()
	{
		if (PHP_VERSION === '5.3.3') {
			$this->markTestSkipped('Skipped due to "Nesting level too deep - recursive dependency?" fatal error');
		}

		$obj = new \stdClass;
		$obj->foo = 'bar';

<<<<<<< HEAD
        $array = array(
            0 => 0,
            'null' => NULL,
            'boolean' => TRUE,
            'integer' => 1,
            'double' => 1.2,
            'string' => '1',
            'text' => "this\nis\na\nvery\nvery\nvery\nvery\nvery\nvery\rlong\n\rtext",
            'object' => $obj,
            'objectagain' => $obj,
            'array' => array('foo' => 'bar'),
        );
=======
		$array = array(
			0 => 0,
			'null' => null,
			'boolean' => true,
			'integer' => 1,
			'double' => 1.2,
			'string' => '1',
			'text' => "this\nis\na\nvery\nvery\nvery\nvery\nvery\nvery\rlong\n\rtext",
			'object' => $obj,
			'objectagain' => $obj,
			'array' => array('foo' => 'bar'),
		);
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

		$array['self'] = &$array;

		$expected = <<<EOF
Array &%d (
    0 => 0
    'null' => null
    'boolean' => true
    'integer' => 1
    'double' => 1.2
    'string' => '1'
    'text' => 'this
is
a
very
very
very
very
very
very
long
text'
    'object' => stdClass Object &%x (
        'foo' => 'bar'
    )
    'objectagain' => stdClass Object &%x
    'array' => Array &%d (
        'foo' => 'bar'
    )
    'self' => Array &%d (
        0 => 0
        'null' => null
        'boolean' => true
        'integer' => 1
        'double' => 1.2
        'string' => '1'
        'text' => 'this
is
a
very
very
very
very
very
very
long
text'
        'object' => stdClass Object &%x
        'objectagain' => stdClass Object &%x
        'array' => Array &%d (
            'foo' => 'bar'
        )
        'self' => Array &%d
    )
)
EOF;

<<<<<<< HEAD
        $this->assertStringMatchesFormat(
            $expected, $this->trimnl($this->exporter->export($array))
        );
    }
=======
		$this->assertStringMatchesFormat(
			$expected,
			$this->trimNewline($this->exporter->export($array))
		);
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	public function shortenedExportProvider()
	{
		$obj = new \stdClass;
		$obj->foo = 'bar';

		$array = array(
			'foo' => 'bar',
		);

<<<<<<< HEAD
        return array(
            array(NULL, 'null'),
            array(TRUE, 'true'),
            array(1, '1'),
            array(1.0, '1.0'),
            array(1.2, '1.2'),
            array('1', "'1'"),
            // \n\r and \r is converted to \n
            array("this\nis\na\nvery\nvery\nvery\nvery\nvery\nvery\rlong\n\rtext", "'this\\nis\\na\\nvery\\nvery\\nvery\\nvery...g\\ntext'"),
            array(new \stdClass, 'stdClass Object ()'),
            array($obj, 'stdClass Object (...)'),
            array(array(), 'Array ()'),
            array($array, 'Array (...)'),
        );
    }

    /**
     * @dataProvider shortenedExportProvider
     */
    public function testShortenedExport($value, $expected)
    {
        $this->assertSame(
          $expected,
          $this->trimnl($this->exporter->shortenedExport($value))
        );
    }

    public function provideNonBinaryMultibyteStrings()
    {
        return array(
            array(implode('', array_map('chr', range(0x09, 0x0d))), 5),
            array(implode('', array_map('chr', range(0x20, 0x7f))), 96),
            array(implode('', array_map('chr', range(0x80, 0xff))), 128),
        );
    }


    /**
     * @dataProvider provideNonBinaryMultibyteStrings
     */
    public function testNonBinaryStringExport($value, $expectedLength)
    {
        $this->assertRegExp(
          "~'.{{$expectedLength}}'\$~s", $this->exporter->export($value)
        );
    }

    protected function trimnl($string)
    {
        return preg_replace('/[ ]*\n/', "\n", $string);
    }
=======
		return array(
			array(null, 'null'),
			array(true, 'true'),
			array(1, '1'),
			array(1.0, '1.0'),
			array(1.2, '1.2'),
			array('1', "'1'"),
			// \n\r and \r is converted to \n
			array("this\nis\na\nvery\nvery\nvery\nvery\nvery\nvery\rlong\n\rtext", "'this\\nis\\na\\nvery\\nvery\\nvery\\nvery...g\\ntext'"),
			array(new \stdClass, 'stdClass Object ()'),
			array($obj, 'stdClass Object (...)'),
			array(array(), 'Array ()'),
			array($array, 'Array (...)'),
		);
	}

	/**
	 * @dataProvider shortenedExportProvider
	 */
	public function testShortenedExport($value, $expected)
	{
		$this->assertSame(
			$expected,
			$this->trimNewline($this->exporter->shortenedExport($value))
		);
	}

	/**
	 * @requires extension mbstring
	 */
	public function testShortenedExportForMultibyteCharacters()
	{
		$oldMbLanguage = mb_language();
		mb_language('Japanese');
		$oldMbInternalEncoding = mb_internal_encoding();
		mb_internal_encoding('UTF-8');

		try {
			$this->assertSame(
			  "'いろはにほへとちりぬるをわかよたれそつねならむうゐのおくや...しゑひもせす'",
			  $this->trimNewline($this->exporter->shortenedExport('いろはにほへとちりぬるをわかよたれそつねならむうゐのおくやまけふこえてあさきゆめみしゑひもせす'))
			);
		} catch (\Exception $e) {
			mb_internal_encoding($oldMbInternalEncoding);
			mb_language($oldMbLanguage);
			throw $e;
		}

		mb_internal_encoding($oldMbInternalEncoding);
		mb_language($oldMbLanguage);
	}

	public function provideNonBinaryMultibyteStrings()
	{
		return array(
			array(implode('', array_map('chr', range(0x09, 0x0d))), 5),
			array(implode('', array_map('chr', range(0x20, 0x7f))), 96),
			array(implode('', array_map('chr', range(0x80, 0xff))), 128),
		);
	}


	/**
	 * @dataProvider provideNonBinaryMultibyteStrings
	 */
	public function testNonBinaryStringExport($value, $expectedLength)
	{
		$this->assertRegExp(
			"~'.{{$expectedLength}}'\$~s",
			$this->exporter->export($value)
		);
	}

	public function testNonObjectCanBeReturnedAsArray()
	{
		$this->assertEquals(array(true), $this->exporter->toArray(true));
	}

	private function trimNewline($string)
	{
		return preg_replace('/[ ]*\n/', "\n", $string);
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
