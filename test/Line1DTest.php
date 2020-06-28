<?php

use Sanbuka\Line1D;

class Line1DTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_be_the_right_size()
    {
        $line = new Line1D(1,2);
        $this->assertTrue($line->getSize() == 1, "Size of Line is: 1");
    }

    // Size 0?

    // Size -1?
}