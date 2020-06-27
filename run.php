<?php

require __DIR__ . '/vendor/autoload.php';

use Sanbuka\Line1D;
use Sanbuka\Cube;

const CMD_EXECUTE_ARGUMENTS = "CMD_EXECUTE_ARGUMENTS";
const CMD_INCORRECT_PARAMETERS = "CMD_INCORRECT_PARAMETERS";
const CMD_EXAMPLE = "CMD_EXAMPLE";
const CMD_NO_PARAM = "CMD_NO_PARAM";


function parse_command($argv) : array
{
    if ( ! array_key_exists(1, $argv)) {
        return ["command" => CMD_NO_PARAM];
    }

    if(! array_key_exists(2, $argv)) {
        return ["command" => CMD_EXAMPLE];
    }

    foreach(range(3,8) as $i){
        if (!array_key_exists($i, $argv)) {
            return ["command" => CMD_INCORRECT_PARAMETERS];
        }
    }

    if (array_key_exists(9, $argv)) {
        return ["command" => CMD_INCORRECT_PARAMETERS];
    }

    return [
        "command" => CMD_EXECUTE_ARGUMENTS,
        "arguments" => $argv
    ];
}

try
{
    $command = parse_command($argv);

    switch($command["command"]) {
        case CMD_INCORRECT_PARAMETERS:
            echo sprintf("Incorrect parameters\n");
        case CMD_NO_PARAM:
            echo "Usage: > php cube.php x1 y1 z1 size1 x2 y2 z2 size2\n";
            break;
        case CMD_EXAMPLE:
            $line = new Line1D(1,2);
            $cube = new Cube(1,2,3,4);
            $otherCube = new Cube(3,2,4,5);
            $farAwayCube = new Cube(13,12,14,5);

            echo sprintf("Size of Line is: %d \n", $line->getSize());
            echo sprintf("Volume of intersection is: %d\n", $cube->getVolumeIntersection($otherCube));
            echo sprintf("Volume of other way round intersection is: %d\n", $otherCube->getVolumeIntersection($cube));
            echo sprintf("Volume of intersection with far away cube is: %d\n", $otherCube->getVolumeIntersection($farAwayCube));
            break;
        case CMD_EXECUTE_ARGUMENTS:
            // if use getopt --interactive get the user to enter parameters, else
            $first_cube = new Cube($argv[1],$argv[2],$argv[3],$argv[4]);
            $second_cube = new Cube($argv[5],$argv[6],$argv[7],$argv[8]);

            echo sprintf("Intersection volume: %d\n", $first_cube->getVolumeIntersection($second_cube));
            break;
    }
}
catch(\InvalidArgumentException $e)
{
    echo sprintf("Error: %s\n", $e->getMessage());
    echo "Usage: > php cube.php x1 y1 z1 size1 x2 y2 z2 size2\n";
}