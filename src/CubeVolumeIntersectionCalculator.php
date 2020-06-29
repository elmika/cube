<?php


namespace Sanbuka;
use Sanbuka\Cube;

class CubeVolumeIntersectionCalculator
{
    public static function run(Cube $cube, Cube $otherCube)
    {
        $x_intersection = $cube->getLine('x')->getIntersection($otherCube->getLine('x'));
        $y_intersection = $cube->getLine('y')->getIntersection($otherCube->getLine('y'));
        $z_intersection = $cube->getLine('z')->getIntersection($otherCube->getLine('z'));

        return $x_intersection->getSize()
            * $y_intersection->getSize()
            * $z_intersection->getSize();
    }
}