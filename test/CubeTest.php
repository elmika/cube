<?php

use Sanbuka\Cube;

class CubeTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_should_calculate_the_volume_of_intersection_with_another_cube()
    {
        $cube = new Cube(1,2,3,4);
        $otherCube = new Cube(3,2,4,5);

        $this->assertTrue(24 == $cube->getVolumeIntersection($otherCube), "Volume of intersection is 24");
    }

    /** @test */
    public function it_should_preserve_intersection_volume_when_cubes_are_inverted()
    {
        $cube = new Cube(1,2,3,4);
        $otherCube = new Cube(3,2,4,5);

        $this->assertTrue($otherCube->getVolumeIntersection($cube) == $cube->getVolumeIntersection($otherCube), "Volume stays the same if we invert cubes before intersecting.");
    }

    /** @test */
    public function it_should_return_0_when_cubes_do_not_intersect()
    {
        $cube = new Cube(1,2,3,4);
        $farAwayCube = new Cube(13,12,14,5);

        $this->assertTrue(0 == $cube->getVolumeIntersection($farAwayCube), "Volume of intersection with far away cube is 0");
    }
}