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
	public function __construct(int $a, int $b)
	{
		$this->min_point = min($a, $b);
		$this->max_point = max($a, $b);
	}

	public function getMin(){ return $this->min_point; }
	public function getMax(){ return $this->max_point; }

	public function getSize() : int
    {
        return $this->getMax() - $this->getMin();
    }

	/**
	* compare two lines.
	* @param Line1D $cd: other line to compare to
	* @return boolean: true if the two lines are a match.
	*  					false if they are distinct
	*/
	private function equals(Line1D $cd)
	{
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
	*  @return Line1D: the intersection of the two lines
	*  @throws InvalidLineIntersection
	*/
	public function getIntersection(Line1D $cd) : Line1D
	{
		if(! $this->intersects($cd)){
		    throw new InvalidLineIntersection("Trying to build intersection of two lines that do not intersect!");
        }

		$min = max($this->getMin(), $cd->getMin());
		$max = min($this->getMax(), $cd->getMax());

		return new Line1D($min, $max);
	}
}
