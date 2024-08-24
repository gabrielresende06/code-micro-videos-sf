<?php

declare(strict_types=1);

namespace Tests\Unit;

use Core\Test;
use PHPUnit\Framework\TestCase;

class TestUnitTest extends TestCase {

    public function testCallMethodFoo()
    {
        $test = new Test();
        $response = $test->foo();
        $this->assertEquals("123", $response);
    }
}