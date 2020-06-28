<?php

use Sanbuka\Cube;

class CubeTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_do_what_it_should()
    {
        $cube = new Cube(1,2,3,4);
        $otherCube = new Cube(3,2,4,5);

        $this->assertTrue(24 == $cube->getVolumeIntersection($otherCube), "Volume of intersection is 27");
    }

    /** @test */
    public function it_should_do_the_other_way_round()
    {
        $cube = new Cube(1,2,3,4);
        $otherCube = new Cube(3,2,4,5);

        $this->assertTrue($otherCube->getVolumeIntersection($cube) == $cube->getVolumeIntersection($otherCube), "Volume stays the same if we invert cubes before intersecting.");
    }

    /** @test */
    public function it_should_do_zero()
    {
        $cube = new Cube(1,2,3,4);
        $farAwayCube = new Cube(13,12,14,5);

        $this->assertTrue(0 == $cube->getVolumeIntersection($farAwayCube), "Volume of intersection with far away cube is 0");
    }
}