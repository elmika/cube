<?php


namespace Sanbuka;

class CubeVolumeIntersectionCalculator
{
    public static function run(Cube $cube, Cube $otherCube)
    {
        foreach(['x', 'y', 'z'] as $i) {
            if(! $cube->getLine($i)->intersects($otherCube->getLine($i))){
                return 0;
            }
        }

        $volume = 1;
        foreach(['x', 'y', 'z'] as $i) {
            $line =  $cube->getLine($i)->getIntersection($otherCube->getLine($i));
            $volume *= $line->getSize();
        }

        return $volume;
    }
}