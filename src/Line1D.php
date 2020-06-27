<?php

namespace Sanbuka;

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
	public function getSize(){ return $this->isNull() ? 0 : ($this->getMax() - $this->getMin()); }

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
