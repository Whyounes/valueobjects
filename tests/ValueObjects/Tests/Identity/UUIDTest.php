<?php

namespace ValueObjects\Tests\Identity;

use ValueObjects\Identity\UUID;
use ValueObjects\Tests\TestCase;

class UUIDTest extends TestCase
{
    public function testFromNative()
    {
        $uuid1 = new UUID();
        $uuid2 = UUID::fromNative($uuid1->toNative());

        $this->assertTrue($uuid1->equals($uuid2));
    }

    public function testEquals()
    {
        $uuid1 = new UUID();
        $uuid2 = clone $uuid1;
        $uuid3 = new UUID();

        $this->assertTrue($uuid1->equals($uuid2));
        $this->assertTrue($uuid2->equals($uuid1));
        $this->assertFalse($uuid1->equals($uuid3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($uuid1->equals($mock));
    }

    /** @expectedException ValueObjects\Exception\InvalidNativeArgumentException */
    public function testInvalid()
    {
        new UUID('invalid');
    }
}