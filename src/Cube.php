<?php

namespace Sanbuka;

class Cube
{
	private $x_line;
	private $y_line;
	private $z_line;

	/**
	* @var int $x coordinate corresponding to x axis
	* @var int $y coordinate corresponding to y axis
	* @var int $z coordinate corresponding to z axis
	* @var int $size size of the edge of the cube. Expected to be positive.
	*/
	public function __construct(int $x, int $y, int $z, int $size)
	{
		if( ! ($size >= 0) 	)		 throw new \InvalidArgumentException("Size is expected to be a positive integer ! ".$size);
		
		$this->x_line = new Line1D($x, $x+$size);
		$this->y_line = new Line1D($y, $y+$size);
		$this->z_line = new Line1D($z, $z+$size);
	}

	public function getXLine(){ return $this->x_line; }
	public function getYLine(){ return $this->y_line; }
	public function getZLine(){ return $this->z_line; }
	public function getLine($label)
	{
		switch($label)
		{
			case 'x': return $this->getXLine(); break;
			case 'y': return $this->getYLine(); break;
			case 'z': return $this->getZLine(); break;
			default: throw new \InvalidArgumentException("Incorrect axis name ".$label);
		}
	}
}
