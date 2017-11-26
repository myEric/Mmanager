<?php
class Issue581Test extends PHPUnit_Framework_TestCase
{
<<<<<<< HEAD
    public function testExportingObjectsDoesNotBreakWindowsLineFeeds() {
        $this->assertEquals(
            (object)array(1,2,"Test\r\n",4,5,6,7,8),
            (object)array(1,2,"Test\r\n",4,1,6,7,8)
        );
    }
=======
	public function testExportingObjectsDoesNotBreakWindowsLineFeeds()
	{
		$this->assertEquals(
			(object) [1, 2, "Test\r\n", 4, 5, 6, 7, 8],
			(object) [1, 2, "Test\r\n", 4, 1, 6, 7, 8]
		);
	}
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e
}
