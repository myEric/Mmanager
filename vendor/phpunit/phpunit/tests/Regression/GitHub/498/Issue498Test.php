<?php

class Issue498Test extends PHPUnit_Framework_TestCase
{
<<<<<<< HEAD

    /**
     * @test
     * @dataProvider shouldBeTrueDataProvider
     * @group falseOnly
     */
    public function shouldBeTrue($testData)
    {
        $this->assertTrue(true);
    }


    /**
     * @test
     * @dataProvider shouldBeFalseDataProvider
     * @group trueOnly
     */
    public function shouldBeFalse($testData)
    {
        $this->assertFalse(false);
    }
=======
	/**
	 * @test
	 * @dataProvider shouldBeTrueDataProvider
	 * @group falseOnly
	 */
	public function shouldBeTrue($testData)
	{
		$this->assertTrue(true);
	}

	/**
	 * @test
	 * @dataProvider shouldBeFalseDataProvider
	 * @group trueOnly
	 */
	public function shouldBeFalse($testData)
	{
		$this->assertFalse(false);
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

	public function shouldBeTrueDataProvider()
	{

<<<<<<< HEAD
        //throw new Exception("Can't create the data");
        return array(
            array(true),
            array(false)
        );
    }

    public function shouldBeFalseDataProvider()
    {

        throw new Exception("Can't create the data");
        return array(
            array(true),
            array(false)
        );
    }
=======
		//throw new Exception("Can't create the data");
		return [
			[true],
			[false]
		];
	}

	public function shouldBeFalseDataProvider()
	{
		throw new Exception("Can't create the data");

		return [
			[true],
			[false]
		];
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
