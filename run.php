<?php

require __DIR__ . '/vendor/autoload.php';

use Sanbuka\Line1D;
use Sanbuka\Cube;

// Main
try
{
    if(array_key_exists(2, $argv)) {
        // if use getopt --interactive get the user to enter parameters, else
        $first_cube = new Cube($argv[1],$argv[2],$argv[3],$argv[4]);
        $second_cube = new Cube($argv[5],$argv[6],$argv[7],$argv[8]);

        echo sprintf("Intersection volume: %d\n", $first_cube->getVolumeIntersection($second_cube));
    }
    elseif(array_key_exists(1, $argv)) {
        $line = new Line1D(1,2);
        $cube = new Cube(1,2,3,4);
        $otherCube = new Cube(3,2,4,5);
        $farAwayCube = new Cube(13,12,14,5);

        echo sprintf("Size of Line is: %d \n", $line->getSize());
        echo sprintf("Volume of intersection is: %d\n", $cube->getVolumeIntersection($otherCube));
        echo sprintf("Volume of other way round intersection is: %d\n", $otherCube->getVolumeIntersection($cube));
        echo sprintf("Volume of intersection with far away cube is: %d\n", $otherCube->getVolumeIntersection($farAwayCube));
    }else{
        echo "\nUse: > php cube.php x1 y1 z1 size1 x2 y2 z2 size2\n";
    }
}
catch(\InvalidArgumentException $e)
{
    echo sprintf("Error: %s\n", $e->getMessage());
    echo "\nUse: > php cube.php x1 y1 z1 size1 x2 y2 z2 size2\n";
}