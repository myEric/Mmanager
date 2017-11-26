<?php
 
use MyEric\Mmanager\Welcome;
 
class WelcomeTest extends PHPUnit_Framework_TestCase {
 
  public function testWelcomeHello()
  {
    $welcome = new Welcome;
    $this->assertTrue($welcome->hello());
  }
 
}