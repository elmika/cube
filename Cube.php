<?php

class Line1D
{
	private $min_point;
	private $max_point;	

	/**
	 *	constructor
	 *  @var int $a one of the two endpoints
	 *	@var int $b the other of the endpoints
	 */
	public function __construct($a=null, $b=null)
	{
		if( is_null($b) ) return;

		if( $this->isInt($a) === false) 	throw new \InvalidArgumentException("Parameters should be integers !");
		if( $this->isInt($b) === false) 	throw new \InvalidArgumentException("Parameters should be integers !");

		$this->min_point = min($a, $b);
		$this->max_point = max($a, $b);
	}

	public function getMin(){ return $this->min_point; }
	public function getMax(){ return $this->max_point; }

	public function isNull(){ return is_null($this->min_point); }
	public function getSize(){ $this->isNull() ? 0 : ($this->getMax() - $this->getMin()); }

	/**
	*	Are we fine with negative numbers ? Should be, but let's test...
	*   @var string $a the value we want to test
	*   @return true if $a is an int or a string converting to an int
	*			false if there is some junk involved
	*/
	public function isInt($a)
	{
		if(! is_numeric($a) ) return false;
		if( ! $a == floor($a) ) return false;
		return true;
	}

	/**
	* compare two lines.
	* Note: a null line is not equal to any line
	* @param Line1D $cd: other line to compare to
	* @return boolean: true if the two lines are a match.
	*  					false if they are distinct
	*/
	private function equals(Line1D $cd)
	{
		if($this->isNull()) 					return false;
		if($cd->isNull())						return false;
		if($this->getMin() != $cd->getMin()) 	return false;
		if($this->getMax() != $cd->getMax()) 	return false;
		return true;
	}

	/**
	 *  intersect: does this line intersect with another line ?
	 *
	 *	@var Line1D $cd: other line
	 *  @return boolean true if we do intersect
	 *					false otherwise
	 */
	public function intersects(Line1D $cd)
	{
		if($this->getMin() > $cd->getMax()) return false;
		if($this->getMax() < $cd->getMin()) return false;
		return true;
	}

	/**
	*	getIntersection: generate line resulting from 
	*					 the intersection to another Line1D
	*  @var Line1D $cd: other line
	*  @return Line1D: the intersection of the two lines.
	*					null if we do not intersect
	*/
	public function getIntersection(Line1D $cd)
	{
		if(! $this->intersects($cd)) return new Line1D();

		$min = max($this->getMin(), $cd->getMin());
		$max = min($this->getMax(), $cd->getMax());

		return new Line1D($min, $max);
	}
}

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
	public function __construct($x, $y, $z, $size)
	{
		$dummy = new Line1D();
		if( ! $dummy->isInt($x) ) 	 throw new \InvalidArgumentException("Parameters should be integers !");
		if( ! $dummy->isInt($y) ) 	 throw new \InvalidArgumentException("Parameters should be integers !");
		if( ! $dummy->isInt($z) ) 	 throw new \InvalidArgumentException("Parameters should be integers !");
		if( ! $dummy->isInt($size) ) throw new \InvalidArgumentException("Parameters should be integers !");
		if( ! ($size >= 0)) 			 throw new \InvalidArgumentException("Size is expected to be a positive integer !");
		
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
			default: throw new \Exception("Incorrect axis name ".$label);
		}
	}

	public function getVolume(){ return $this->size * $this->size * $this->size; }
	public function getVolumeIntersection(Cube $c)
	{
		$x_intersection = $this->getLine('x')->getIntersection($c->getLine('x'));
		$y_intersection = $this->getLine('y')->getIntersection($c->getLine('y'));
		$z_intersection = $this->getLine('z')->getIntersection($c->getLine('z'));

		return $x_intersection->getSize() 
					* $y_intersection->getSize() 
						* $z_intersection->getSize();
	}
}

$line = new Line1D();
$cube = new Cube(1,2,3,4);
$otherCube = new Cube(2,3,4,5);

$volume = $cube->getVolumeIntersection($otherCube);

echo "Volume of intersection is:".$volume."\n";