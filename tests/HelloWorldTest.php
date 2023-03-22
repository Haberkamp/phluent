<?php

namespace Doblhofer\Tests;

use Doblhofer\HelloWorld;
use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase
{
    public function testSayHello()
    {
        $helloWorld = new HelloWorld();
        $this->assertEquals('Hello World!', $helloWorld->sayHello());
    }
}
