<?php


namespace Sanbuka;
use Sanbuka\Cube;

class CubeVolumeIntersectionCalculator
{
    public static function run(Cube $cube, Cube $otherCube)
    {
        return $cube->getVolumeIntersection($otherCube);
    }
}