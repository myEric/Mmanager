<?php
class FailureTest extends PHPUnit_Framework_TestCase
{
<<<<<<< HEAD
    public function testAssertArrayEqualsArray()
    {
        $this->assertEquals(array(1), array(2), 'message');
    }
=======
	public function testAssertArrayEqualsArray()
	{
		$this->assertEquals([1], [2], 'message');
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	public function testAssertIntegerEqualsInteger()
	{
		$this->assertEquals(1, 2, 'message');
	}

<<<<<<< HEAD
    public function testAssertObjectEqualsObject()
    {
        $a = new StdClass;
        $a->foo = 'bar';

        $b = new StdClass;
        $b->bar = 'foo';
=======
	public function testAssertObjectEqualsObject()
	{
		$a      = new StdClass;
		$a->foo = 'bar';

		$b      = new StdClass;
		$b->bar = 'foo';
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

		$this->assertEquals($a, $b, 'message');
	}

	public function testAssertNullEqualsString()
	{
		$this->assertEquals(null, 'bar', 'message');
	}

	public function testAssertStringEqualsString()
	{
		$this->assertEquals('foo', 'bar', 'message');
	}

	public function testAssertTextEqualsText()
	{
		$this->assertEquals("foo\nbar\n", "foo\nbaz\n", 'message');
	}

	public function testAssertStringMatchesFormat()
	{
		$this->assertStringMatchesFormat('*%s*', '**', 'message');
	}

	public function testAssertNumericEqualsNumeric()
	{
		$this->assertEquals(1, 2, 'message');
	}

	public function testAssertTextSameText()
	{
		$this->assertSame('foo', 'bar', 'message');
	}

	public function testAssertObjectSameObject()
	{
		$this->assertSame(new StdClass, new StdClass, 'message');
	}

	public function testAssertObjectSameNull()
	{
		$this->assertSame(new StdClass, null, 'message');
	}

	public function testAssertFloatSameFloat()
	{
		$this->assertSame(1.0, 1.5, 'message');
	}

<<<<<<< HEAD
    // Note that due to the implementation of this assertion it counts as 2 asserts
    public function testAssertStringMatchesFormatFile()
    {
        $this->assertStringMatchesFormatFile(__DIR__ . '/expectedFileFormat.txt', '...BAR...');
    }

=======
	// Note that due to the implementation of this assertion it counts as 2 asserts
	public function testAssertStringMatchesFormatFile()
	{
		$this->assertStringMatchesFormatFile(__DIR__ . '/expectedFileFormat.txt', '...BAR...');
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
