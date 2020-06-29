<?php

use Sanbuka\Line1D;

class Line1DTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_throw_an_invalid_argument_exception()
    {
        $this->expectException(TypeError::class);
        $line = new Line1D("a", "b");
    }

    /** @test */
    public function it_should_calculate_its_own_size()
    {
        $line = new Line1D(1,2);
        $this->assertTrue($line->getSize() == 1, "Size of Line is: 1");
    }

    /** @test */
    public function it_should_calculate_its_own_bigger_size()
    {
        $line = new Line1D(-1,5);
        $this->assertTrue($line->getSize() == 6, "Size of Line is: 6");
    }

    /** @test */
    public function it_should_calculate_its_own_size_when_0()
    {
        $line = new Line1D(1,1);
        $this->assertTrue($line->getSize() == 0, "Size of Line is: 0");
    }

    /** @test */
    public function it_should_calculate_its_own_size_when_negative()
    {
        $line = new Line1D(2,1);
        $this->assertTrue($line->getSize() == 1, "Size of Line is: 1");
    }

    /** @test */
    public function it_should_say_when_there_is_an_intersection_with_another_line()
    {
        $line = new Line1D(1,4);
        $otherLine = new Line1D(3,7);
        $this->assertTrue($line->intersects($otherLine), "Two lines intersect partially");
    }

    /** @test */
    public function it_should_say_when_there_is_an_intersection_with_another_bigger_line()
    {
        $line = new Line1D(1,4);
        $otherLine = new Line1D(0,7);
        $this->assertTrue($line->intersects($otherLine), "One line in within the other line");
        $this->assertTrue($otherLine->intersects($line), "One line in within the other line");
    }
}