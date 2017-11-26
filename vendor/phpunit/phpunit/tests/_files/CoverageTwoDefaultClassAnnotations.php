<?php

/**
 * @coversDefaultClass \NamespaceOne
 * @coversDefaultClass \AnotherDefault\Name\Space\Does\Not\Work
 */
class CoverageTwoDefaultClassAnnotations
{
<<<<<<< HEAD

    /**
     * @covers Foo\CoveredClass::<public>
     */
    public function testSomething()
    {
        $o = new Foo\CoveredClass;
        $o->publicMethod();
    }

=======
	/**
	 * @covers Foo\CoveredClass::<public>
	 */
	public function testSomething()
	{
		$o = new Foo\CoveredClass;
		$o->publicMethod();
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
